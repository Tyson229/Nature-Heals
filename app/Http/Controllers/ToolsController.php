<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tools;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\linkList;
use App\Models\userCreatesTool;
use SebastianBergmann\Environment\Console;

use function PHPUnit\Framework\isNull;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = DB::table('tool_statuses')
                ->join('tools','tools.status_ID','=','tool_statuses.id')
                -> select('tools.*','tool_statuses.status')
                ->orderBy('tools.created_at','desc')
                ->paginate(7);

        $link = DB::table('tools')
                ->join('link_lists','link_lists.tool_ID','=','tools.id')
                -> select('tools.id','link_lists.study_name','link_lists.link')
                ->get();        
        return view('AdminSide.tools')->with('tools', $tools)->with('link_lists',$link);       
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
        $tool->measure =$request -> createMeasure;
        $tool->program_content =$request -> createProgramContent;
        $tool->status_ID = 1;
        $tool->created_at = now();
        $tool->updated_at = now();

        $tool->save();

        $temp_id = tools::orderBy('created_at','desc')->first()->id;

        //Add study if have
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
        $connection->user_ID = 3;
        $connection->tool_ID = $temp_id;
        $connection->save();

        return redirect('login/tools')->with('message','Successfully Created Tool!');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
