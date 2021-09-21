<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\tools;
use App\Models\request as tool_request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\linkList;
use App\Models\userCreatesTool;


class AdminRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user() && Auth::user()->role_ID == 1){
            $tools = DB::table('tools')
                    ->join('requests','requests.tool_ID','=','tools.id')
                    ->where([
                        [ function ($query) use ($request){
                            if(($term = $request->term)){
                                $query->orWhere('tools.tool_name','LIKE','%'.$term.'%' )
                                    ->orWhere('tools.health_domain','=',$term )
                                    ->orWhere('requests.visitor_name','LIKE','%'.$term.'%' );
                            }
                        }]
                    ])
                    ->orderBy('tools.created_at','desc')
                    ->paginate(7);

            $link = DB::table('tools')
                    ->join('link_lists','link_lists.tool_ID','=','tools.id')
                    -> select('tools.id','link_lists.study_name','link_lists.link')
                    ->get();

            return view('AdminSide.pendingRequest')->with('tools', $tools)->with('link_lists',$link);
        }
        else
            return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(isset($request->decline)){
            return $this->destroy($id);
        }else{
        $validator = Validator::make($request->all(),[
            //Tools details
            'requestToolName' => 'bail|required|string',
            'requestDescription' => 'required|string',

            'requestStudyLabel-'.$id => 'nullable|string',
            'requestLinkLabel-'.$id => 'nullable|url',

            'requestMoreStudyLabel-'.$id => 'array|min:1',
            'requestMoreStudyLabel-'.$id.'.*'=> 'string',
            'requestMoreLinkLabel-'.$id => 'array|min:1',
            'requestMoreLinkLabel-'.$id.'.*' => 'nullable|url',
            //'createAttachmentLabel' => 'file',

            //Additional details
            'requestOutcome' => 'nullable|string',
            'requestGenderLabel' => 'nullable|alpha',
            'requestReliability' => 'nullable|alpha',

            //Journal details
            'requestAuthor' => 'nullable|string',
            'requestTitle' => 'nullable|string',
            'requestYear' => 'nullable|numeric',
            'requestCountry' => 'nullable|string',
            'requestJournal' => 'nullable|string',
        ],[
            'requestToolName.required' => 'Tool Name is required',
            'requestToolName.alpha_num' => 'Tool Name must be alphanumeric only',
            'requestToolName.string' => 'Tool Name must be alphanumeric only',

            'requestDescription.required' => 'Tool description is required',
            'requestDescription.string' => 'Tool description must be alphanumeric only',

            'requestStudyLabel.string' => 'Study Name must be alphanumeric only',
            'requestStudyLabel.alpha_num' => 'Study Name must be alphanumeric only',
            'requestLinkLabel.url'=>'Link must be a URL',

            'requestMoreStudyLabel.*.string' => 'Study Name must be alphanumeric only',
            'requestMoreStudyLabel.*.alpha_num' => 'Study Name must be alphanumeric only',
            'requestMoreLinkLabel.*.url'=>'Link must be an URL',

        ]);

        if($validator->fails()){
            return back()->withErrors($validator,'update')->with('id',$id);
        }

        //Check if the request is a edited version of a tool by
        //checking if request is a copy version of a tool using the
        //request table
        
        
        $orgID = tool_request::where('tool_ID',$id)->first()->copy_of;
        //$orgID = DB::table('requests')->where('tool_ID',$id)->first()->copy_of;
        //$orgID = $copy_request->select('copy_of')->first();
        //if found it is the copy version
        if(!is_null($orgID))
            $tool= tools::find($orgID); //Yes -> get the original ID to make update
        else
            $tool= tools::find($id); //No -> understand the request is not a duplicate version

            $tool->tool_name = $request->requestToolName;
            $tool->tool_description= $request ->requestDescription;
            $tool->health_domain = $request ->requestHealthDomain;
            $tool ->age_group = $request->requestAgeGroup;
            $tool ->notes = $request->requestNotes;
            
            //Add additional details
            $tool->outcome = $request->requestOutcome;
            $tool->gender = $request->requestGender;
            $tool->health_condition = $request->requestCondition;
            $tool->modality = $request->requestModality;
            $tool->specific_NB = $request->requestSpecificNB;
            if(strcmp(($request->requestSpecificNB),"Yes")==0){
                $tool->settings = $request->requestSetting;
            }else{
                $tool->settings = "Not Applicable";
            }
            $tool->reliability = $request-> requestReliability;
            $tool->validity = $request -> requestValidity;
    
            //Add author details
            $tool->author = $request -> requestAuthor;
            $tool->title = $request -> requestTitle;
            $tool->year = $request ->requestYear;
            $tool->country = $request ->requestCountry;
            $tool->article = $request->requestJournal;
            $tool->measure =$request -> requestMeasure;
            $tool->program_content =$request -> requestProgramContent;
            if(is_null($orgID)){
                $tool->status_ID = 1;
            }

            

            $tool->updated_at = now();
    
            $tool->save();
    
            //Add study if have
            $temp1 = 'requestStudyLabel-'.$id;
            $temp2 = 'requestLinkLabel-'.$id;
            if(!is_null($orgID)){
                $linkList = linkList::where('tool_ID',$orgID);
                $linkList->delete();
            }
            else{
                $linkList = linkList::where('tool_ID',$id);
                $linkList->delete();
            }
            
            if(!is_null($request->$temp1)){
                $linkList = new linkList;
                $linkList->study_name = $request->$temp1;
                $linkList->link = $request->$temp2;
                $linkList->updated_at= now();
                $linkList->created_at = now();
                if(!is_null($orgID))
                    $linkList->tool_ID = $orgID; //Yes -> get the original ID to make update
                else
                    $linkList->tool_ID = $id;
                $linkList->save();
            }
    
            $temp3 = 'requestMoreStudyLabel-'.$id;
            $temp4 = 'requestMoreLinkLabel-'.$id;
            if(!is_null($request->$temp3)){
                $studiesCount = count($request->$temp3);
                for( $i = 0; $i < $studiesCount ; $i++){
                    $linkList = new linkList;
                    $linkList->study_name = ($request->$temp3)[$i];
                    $linkList->link = ($request->$temp4)[$i];
                    $linkList->updated_at= now();
                    $linkList->created_at = now();

                    if(!is_null($orgID))
                        $linkList->tool_ID = $orgID; //Yes -> get the original ID to make update
                    else
                        $linkList->tool_ID = $id;
                    $linkList->save();
                }
            } 
    
            //Update connections between user and tools
            //If an editted version is approved, create another entry in this table. If not, ignore
            $requestor_ID = userCreatesTool::where('tool_ID',$id)->first()->user_ID;
            if(userCreatesTool::where('user_ID','=',$requestor_ID)->where('tool_ID','=',$orgID)->count()==0 && $orgID != Null){
                $connection = new userCreatesTool;
                $connection->user_ID = $requestor_ID; // Change into id of the changer
                $connection->tool_ID = $orgID;
                $connection->save();
            }


            //Once finish updating the orginal one, delete the copy
            if(!is_null($orgID)){
                linkList::where('tool_ID',$id)->delete();
                userCreatesTool::where('tool_ID','=',$id)->delete();
                tool_request::where('tool_ID',$id)->delete();
                tools::where('id',$id)->delete();
            }
            else
                tool_request::where('tool_ID',$id)->delete();
        }
        return redirect('login/request')->with('message','Successfully Approve the Request!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        linkList::where('tool_ID',$id)->delete();
        userCreatesTool::where('tool_ID','=',$id)->delete();
        tool_request::where('tool_ID',$id)->delete();
        tools::where('id',$id)->delete();

        return redirect('login/request')->with('message', 'Successfully Deleted Request!');       
    }
}
