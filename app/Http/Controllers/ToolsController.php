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
use App\Models\toolsFeedback as ToolFeedbackModel;

class ToolsController extends Controller
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
                    ->join('tool_statuses','tools.status_ID','=','tool_statuses.id')
                    ->select('tools.*','tool_statuses.status')
                   
                    ->where([
                        [ function ($query) use ($request){
                            if(($term = $request->term)){
                                $query->orWhere('tools.tool_name','LIKE','%'.$term.'%' )
                                    ->orWhere('tools.health_domain','=',$term );
                            }
                        }]
                    ])
                    ->where('tool_statuses.status','<>','Draft')
                    ->where('tool_statuses.status','<>','Request')
                    ->orderBy('tools.created_at','desc')
                    ->paginate(7)
                    ->appends(['term'=>$request->term]);

            $link = DB::table('tools')
                    ->join('link_lists','link_lists.tool_ID','=','tools.id')
                    -> select('tools.id','link_lists.study_name','link_lists.link')
                    ->get();
            
            $requests = tool_request::get();        
            $request_number = count($requests);        

            return view('AdminSide.tools')->with('tools', $tools)->with('link_lists',$link)->with('request_number',$request_number);
        }
        else
            return back();       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            //Tools details
            'createToolName' => 'bail|required|string',
            'createDescription' => 'required|string',
            'createStudyLabel' => 'nullable|string',
            'createLinkLabel' => 'nullable|url',

            'createMoreStudyLabel' => 'array|min:1',
            'createMoreStudyLabel.*'=> 'string',
            'createMoreLinkLabel' => 'array|min:1',
            'createMoreLinkLabel.*' => 'nullable|url',
            //'createAttachmentLabel' => 'file',

            //Additional details
            'createOutcome' => 'nullable|string',
            'createGenderLabel' => 'nullable|alpha',
            'createReliability' => 'nullable|alpha',

            //Journal details
            'createAuthor' => 'nullable|string',
            'createTitle' => 'nullable|string',
            'createYear' => 'nullable|numeric',
            'createCountry' => 'nullable|string',
            'createJournal' => 'nullable|string',
        ],[
            'createToolName.required' => 'Tool Name is required',
            'createToolName.alpha_num' => 'Tool Name must be alphanumeric only',
            'createToolName.string' => 'Tool Name must be alphanumeric only',

            'createDescription.required' => 'Tool description is required',
            'createDescription.string' => 'Tool description must be alphanumeric only',

            'createStudyLabel.string' => 'Study Name must be alphanumeric only',
            'createStudyLabel.alpha_num' => 'Study Name must be alphanumeric only',
            'createLinkLabel.url'=>'Link must be a URL',

            'createMoreStudyLabel.*.string' => 'Study Name must be alphanumeric only',
            'createMoreStudyLabel.*.alpha_num' => 'Study Name must be alphanumeric only',
            'createMoreLinkLabel.*.url'=>'Link must be an URL',

        ]);

        if($validator->fails()){
            return redirect('login/tools')->withErrors($validator,'store')->withInput();
        }

        //Add Main details
        $tool = new tools;
        $tool->tool_name = $request->createToolName;
        $tool->tool_description= $request ->createDescription;
        $tool->health_domain = $request ->createHealthDomain;
        $tool ->age_group = $request->createAgeGroup;
        $tool ->notes = $request->createNotes;
        
        //Add additional details
        $tool->outcome = $request->createOutcome;
        $tool->gender = $request->createGender;
        $tool->health_condition = $request->createCondition;
        $tool->modality = $request->createModality;
        $tool->specific_NB = $request->createSpecificNB;
        if(strcmp(($request->createSpecificNB),"Yes")==0){
            $tool->settings = $request->createSetting;
        }else{
            $tool->settings = "Not Applicable";
        }
        $tool->reliability = $request-> createReliability;
        $tool->validity = $request -> createValidity;

        //Add author details
        $tool->author = $request -> createAuthor;
        $tool->title = $request -> createTitle;
        $tool->year = $request ->createYear;
        $tool->country = $request ->createCountry;
        $tool->article = $request->createJournal;

        if(isset($request->saveDraft)) {
            $tool->status_ID = 3;
            $message='Save as draft successfully!';
        }
        elseif(isset($request->add)  ){ /*If save button is pressed, if Admin, the tool will be request. If Owner, the tool will be published*/
            if(Auth::user()->role_ID == 1)
            {
                $tool->status_ID = 1; //Owner privillege
                $message='Successfully Created Tool!';
            }
            else
            {
                $tool->status_ID = 4; //Admin privillege
                $message = 'Successfully Submitted Tool! Please wait for the Owner approval';
            }         
         }          
        $tool->created_at = now();
        $tool->updated_at = now();

        $tool->save();

        $temp_id = $tool->id;
        
        //Create request table
        if(isset($request->add) && Auth::user()->role_ID ==2){
            $admin_request = new tool_request();
            $admin_request->visitor_name = Auth::user()->fname ." ". Auth::user()->lname;
            $admin_request->org_name=Null;
            $admin_request->visitor_email = Auth::user()->email;
            $admin_request->date = now();
            $admin_request->tool_ID = $temp_id;
            $admin_request->internal_request = TRUE;
            $admin_request->copy_of = Null;
            $admin_request->created_at = now();
            $admin_request->updated_at = now();
            $admin_request->save();
        }
        
        //Add study and links if have
        if(!is_null($request->createStudyLabel)){
            $linkList = new linkList;
            $linkList->study_name = $request->createStudyLabel;
            $linkList->link = $request->createLinkLabel;
            $linkList->created_at= now();
            $linkList->updated_at= now();
            $linkList->tool_ID = $temp_id;
            $linkList->save();
        }
        if(!is_null($request->createMoreStudyLabel)){
            $studiesCount = count($request->createMoreStudyLabel);
            for( $i = 0; $i <  $studiesCount;$i++){
                $linkList = new linkList;
                $linkList->study_name = ($request->createMoreStudyLabel)[$i];
                $linkList->link = ($request->createMoreLinkLabel)[$i];
                $linkList->created_at= now();
                $linkList->updated_at= now();
                $linkList->tool_ID = $temp_id;
                $linkList->save();
            }
        } 

        //create connection between user and tool
        $connection = new userCreatesTool;
        $connection->user_ID = Auth::user()->id;
        $connection->tool_ID = $temp_id;
        $connection->save();

        return redirect('login/tools')->with('message',$message);
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
        if(isset($request->publish_switch)){
            $tool = tools::find($id);
            $tool->status_ID = $request->publish_switch;
            $tool->updated_at = now();
            $tool->save(); 
            $message = 'Successfully Updated Tool!';
        }else{
            $validator = Validator::make($request->all(),[
                //Tools details
                'editToolName' => 'bail|required|string',
                'editDescription' => 'required|string',

                'editStudyLabel-'.$id => 'nullable|string',
                'editLinkLabel-'.$id => 'nullable|url',

                'editMoreStudyLabel-'.$id => 'array|min:1',
                'editMoreStudyLabel-'.$id.'.*'=> 'string',
                'editMoreLinkLabel-'.$id => 'array|min:1',
                'editMoreLinkLabel-'.$id.'.*' => 'nullable|url',
                //'createAttachmentLabel' => 'file',

                //Additional details
                'editOutcome' => 'nullable|string',
                'editGenderLabel' => 'nullable|alpha',
                'editReliability' => 'nullable|alpha',

                //Journal details
                'editAuthor' => 'nullable|string',
                'editTitle' => 'nullable|string',
                'editYear' => 'nullable|numeric',
                'editCountry' => 'nullable|string',
                'editJournal' => 'nullable|string',
            ],[
                'editToolName.required' => 'Tool Name is required',
                'editToolName.alpha_num' => 'Tool Name must be alphanumeric only',
                'editToolName.string' => 'Tool Name must be alphanumeric only',

                'editDescription.required' => 'Tool description is required',
                'editDescription.string' => 'Tool description must be alphanumeric only',

                'editStudyLabel.string' => 'Study Name must be alphanumeric only',
                'editStudyLabel.alpha_num' => 'Study Name must be alphanumeric only',
                'editLinkLabel.url'=>'Link must be a URL',

                'editMoreStudyLabel.*.string' => 'Study Name must be alphanumeric only',
                'editMoreStudyLabel.*.alpha_num' => 'Study Name must be alphanumeric only',
                'editMoreLinkLabel.*.url'=>'Link must be an URL',

            ]);

            if($validator->fails()){
                return back()->withErrors($validator,'update')->with('id',$id);
            }

            $tool= Null;
            //Add/Edit Main details
            if(Auth::user()->role_ID==1) {//Owner can edit
                $tool = tools::find($id);
                $message = 'Successfully Updated Tool!';
            }    
            else {
                $tool = new tools;    //Admin need to make request
                $message = 'Successfully Submitted Tool! Please wait for the Owner approval';
            }    
            $tool->tool_name = $request->editToolName;
            $tool->tool_description= $request ->editDescription;
            $tool->health_domain = $request ->editHealthDomain;
            $tool ->age_group = $request->editAgeGroup;
            $tool ->notes = $request->editNotes;
            
            //Add additional details
            $tool->outcome = $request->editOutcome;
            $tool->gender = $request->editGender;
            $tool->health_condition = $request->editCondition;
            $tool->modality = $request->editModality;
            $tool->specific_NB = $request->editSpecificNB;
            if(strcmp(($request->editSpecificNB),"Yes")==0){
                $tool->settings = $request->editSetting;
            }else{
                $tool->settings = "Not Applicable";
            }
            $tool->reliability = $request-> editReliability;
            $tool->validity = $request -> editValidity;

            //Add author details
            $tool->author = $request -> editAuthor;
            $tool->title = $request -> editTitle;
            $tool->year = $request ->editYear;
            $tool->country = $request ->editCountry;
            $tool->article = $request->editJournal;

            //If admin edits, a copy will be created and move to the request
            if(Auth::user()->role_ID==2){
                $tool->status_ID = 4;
                $tool->created_at = now();
            }    
            $tool->updated_at = now();

            $tool->save();

            //Create request table
            if(Auth::user()->role_ID ==2){

                $admin_request = new tool_request();
                $admin_request->visitor_name = Auth::user()->fname ." " . Auth::user()->lname;
                $admin_request->org_name=Null;
                $admin_request->visitor_email = Auth::user()->email;
                $admin_request->date = now();
                $admin_request->tool_ID = tools::orderBy('created_at','desc')->first()->id;
                $admin_request->internal_request = TRUE;
                $admin_request->copy_of = $id;
                $admin_request->created_at = now();
                $admin_request->updated_at = now();
                $admin_request->save();
            }

            //Add study if have
            $temp1 = 'editStudyLabel-'.$id;
            $temp2 = 'editLinkLabel-'.$id;
            //What if the editted version doesn't have any studies while the old one has ? 
            //we need to delete the current first then do the overide work later
            if(Auth::user()->role_ID==1){
                $linkList = linkList::where('tool_ID',$id);
                $linkList->delete();
            }
            if(!is_null($request->$temp1)){
                $linkList = new linkList;
                $linkList->study_name = $request->$temp1;
                $linkList->link = $request->$temp2;
                $linkList->updated_at= now();
                $linkList->created_at = now();
                if(Auth::user()->role_ID==1)
                    $linkList->tool_ID = $id;
                else
                    $linkList->tool_ID = tools::orderBy('created_at','desc')->first()->id;    
                $linkList->save();
            }

            $temp3 = 'editMoreStudyLabel-'.$id;
            $temp4 = 'editMoreLinkLabel-'.$id;
            if(!is_null($request->$temp3)){
                $studiesCount = count($request->$temp3);
                for( $i = 0; $i < $studiesCount ; $i++){
                    $linkList = new linkList;
                    $linkList->study_name = ($request->$temp3)[$i];
                    $linkList->link = ($request->$temp4)[$i];
                    $linkList->updated_at= now();
                    $linkList->created_at = now();
                    if(Auth::user()->role_ID==1)
                        $linkList->tool_ID = $id;
                    else
                        $linkList->tool_ID = tools::orderBy('created_at','desc')->first()->id;
                    $linkList->save();
                }
            } 

            $temp_id = tools::orderBy('created_at','desc')->first()->id;
            //When tool is edited, create another connection between the editor and the tool. If it already exists, ignore
            if(userCreatesTool::where('user_ID','=',Auth::user()->id)->where('tool_ID','=',$id)->count()==0 && Auth::user()->role_ID ==1){
                $connection = new userCreatesTool;
                $connection->user_ID = Auth::user()->id; // Change into id of the changer
                $connection->tool_ID = $id;
                $connection->save();
                
            }
            elseif(userCreatesTool::where('user_ID','=',Auth::user()->id)->where('tool_ID','=',$temp_id)->count()==0 && Auth::user()->role_ID==2){
                $connection = new userCreatesTool;
                $connection->user_ID = Auth::user()->id; // Change into id of the changer
                $connection->tool_ID = $temp_id;
                $connection->save();
            }
        }
        return redirect('login/tools')->with('message',$message);
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
        ToolFeedbackModel::where('tool_ID', '=',$id)->delete();
        $tool = tools::find($id);
        $tool->delete();
        
       
        return redirect('login/tools')->with('message', 'Successfully Deleted Tool!');
    }

    /**
     * store tool feedback in database
     * 
     * @param int $id i.e. toolId
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function storeFeedback($id, Request $request)
    {
        $feedback = new ToolFeedbackModel();

        $feedback->name = $request->fname . ' ' . $request->lname;
        $feedback->email = $request->email;
        $feedback->comment = $request->comment;
        $feedback->tool_ID = $id;

        $feedback->save();

        return back()->with('message', 'Your Feedback has been submitted successfully.');
    }
}
