<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\tools;
use App\Models\request as tool_request;
use Illuminate\Support\Facades\Validator;
use App\Models\linkList;
use App\Models\userCreatesTool;
use App\Models\User;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('UserSide.request');
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
            return redirect('/request')->withErrors($validator,'store')->withInput();
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
        $tool->status_ID = 4;
        
        $credit = 'Contributed by '.$request->visitorName.' ';
        if(!is_null($request->orgName))
            $credit = $credit.'('.$request->orgName.') ';
        $credit = $credit.$request->visitorEmail;    
        $tool->creadit = $credit;
        
        $tool->created_at = now();
        $tool->updated_at = now();

        $tool->save();

        //$temp_id = tools::orderBy('created_at','desc')->first()->id;
        $temp_id = $tool->id;
        //Create request table
        $admin_request = new tool_request();
        $admin_request->visitor_name = $request->visitorName;
        $admin_request->org_name=$request->orgName;
        $admin_request->visitor_email = $request->visitorEmail;
        $admin_request->date = now();
        $admin_request->tool_ID = $temp_id;
        $admin_request->internal_request = FALSE;
        $admin_request->copy_of = Null;
        $admin_request->created_at = now();
        $admin_request->updated_at = now();
        $admin_request->save();

        
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
        $connection->user_ID = User::where('role_ID',1)->first()->id;
        $connection->tool_ID = $temp_id;
        $connection->save();
        
        return redirect('/request')->with('message','Successfully Submitted Tool! Please wait for the Owner approval');
    }

}
