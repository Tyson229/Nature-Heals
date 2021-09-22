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

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()){
            $tools = DB::table('tools')
                    ->join('user_creates_tools','tool_ID','=','id')
                    ->join('users','users.id','=','user_ID')
                    ->select('users.fname','users.lname','user_creates_tools.*','tools.*')
                    ->where('status_ID',3)
                    ->where([
                        [ function ($query) use ($request){
                            if(($term = $request->term)){
                                $query->orWhere('tools.tool_name','LIKE','%'.$term.'%' )
                                    ->orWhere('tools.health_domain','=',$term );
                            }
                        }]
                    ])
                    ->orderBy('tools.created_at','desc')
                    ->paginate(7)
                    ->appends(['term'=>$request->term]);;

            $link = DB::table('tools')
                    ->join('link_lists','link_lists.tool_ID','=','tools.id')
                    -> select('tools.id','link_lists.study_name','link_lists.link')
                    ->get();

            return view('AdminSide.draft')->with('tools', $tools)->with('link_lists',$link);
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
        //Validate the input
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

        //If fails, throw errors
        if($validator->fails()){
            return back()->withErrors($validator,'update')->with('id',$id);
        }


        //If pass validation, find that draft in the database
        $tool= tools::find($id); 

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

        //If owner saves, change the tool status to 1
        //If admin saves, change the tool status to 4
        if(isset($request->save)){
            if(Auth::user()->role_ID == 1){
                $tool->status_ID = 1;
                $message = 'Successfully Created Tool!';
            }else{
                $tool->status_ID = 4;
                $message = 'Successfully Submitted Tool! Please wait for the Owner approval';
            }
        }else{
            $message = 'Draft saved';
        }
        $tool->updated_at = now();
        $tool->save();
    
        //update study if have
        $temp1 = 'requestStudyLabel-'.$id;
        $temp2 = 'requestLinkLabel-'.$id;
        
        $linkList = linkList::where('tool_ID',$id);
        $linkList->delete();
        
        if(!is_null($request->$temp1)){
            $linkList = new linkList;
            $linkList->study_name = $request->$temp1;
            $linkList->link = $request->$temp2;
            $linkList->updated_at= now();
            $linkList->created_at = now();
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
                $linkList->tool_ID = $id;
                $linkList->save();
            }
        } 

        //create request entry if admin submit the draft as tool
        if(isset($request->save) && Auth::user()->role_ID == 2){
            $admin_request = new tool_request();
            $admin_request->visitor_name = Auth::user()->fname ." ". Auth::user()->lname;
            $admin_request->org_name=Null;
            $admin_request->visitor_email = Auth::user()->email;
            $admin_request->date = now();
            $admin_request->tool_ID = $id;
            $admin_request->internal_request = TRUE;
            $admin_request->copy_of = Null;
            $admin_request->created_at = now();
            $admin_request->updated_at = now();
            $admin_request->save();
        }
        

        //Update connections between user and tools
        //If there is already have a connection, ignore. If not create one
        if(userCreatesTool::where('user_ID','=',Auth::user()->id)->where('tool_ID','=',$id)->count()==0){
            $connection = new userCreatesTool;
            $connection->user_ID = Auth::user()->id; // Change into id of the changer
            $connection->tool_ID = $id;
            $connection->save();
        }
        
        return redirect('login/draft')->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $linkList = linkList::where('tool_ID',$id);
        $linkList->delete();
        $connection = userCreatesTool::where('tool_ID',$id);
        $connection->delete();
        $tool = tools::find($id);
        $tool->delete();
       
        return redirect('login/draft')->with('message', 'Successfully Deleted Draft!');
    }
}
