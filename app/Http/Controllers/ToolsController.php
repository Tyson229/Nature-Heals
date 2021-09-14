<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tools;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\linkList;
use App\Models\userCreatesTool;

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
        $tools = DB::table('tools')
                ->join('tool_statuses','status_ID','=','tool_statuses.id')
                -> select('tools.*','tool_statuses.status')
                ->join('link_lists','tools.id','=','link_lists.tool_ID')
                -> select('tools.*','tool_statuses.status','link_lists.study_name','link_lists.link')
                ->orderBy('tools.id','desc')
                ->paginate(7);

        return view('AdminSide.tools')->with('tools', $tools);       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'createToolName' => 'bail|required|alpha_num|string',
            'createStudyLabel' => 'nullable|string|alpha_num',
            'createLinkLabel' => 'nullable|url',
            'createMoreStudyLabel' => 'arrray|min:1',
            'createMoreStudyLabel.*'=> 'string|alpha_num',
            'createMoreLinkLabel' => 'array|min:1',
            'createMoreLinkLabel.*' => 'nullable|url',
            //'createAttachmentLabel' => 'file',

            //Additional details
            'createOutcome' => 'nullable|string|alpha',
            'createGenderLabel' => 'nullable|string|alpha',
            'createReliability' => 'nullable|alpha',

            //Journal details
            'createAuthor' => 'nullable|string',
            'createTitle' => 'nullable|string',
            'createYear' => 'nullable|numeric',
            'createCountry' => 'nullable|alpha|string',
            'createJournal' => 'nullable|string',
        ],[
            'createToolName.required' => 'Tool Name is required',
            'createToolName.alpha_num' => 'Tool Name must be alphanumeric only',
            'createToolName.string' => 'Tool Name must be alphanumeric only',

            'createStudyLabel.string' => 'Study Name must be alphanumeric only',
            'createStudyLabel.alpha_num' => 'Study Name must be alphanumeric only',
            'createLinkLabel.url'=>'Link must be a URL',

            'createMoreStudyLabel.*.string' => 'Study Name must be alphanumeric only',
            'createMoreStudyLabel.*.alpha_num' => 'Study Name must be alphanumeric only',
            'createMoreLinkLabel.*.url'=>'Link must be a URL',

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

        //Add study if have
        if(!isNull($request->createStudyLabel)){
            $linkList = new linkList;
            $linkList->study_name = $request->createStudyLabel;
            $linkList->link = $request->createLinkLabel;
            $linkList->created_at= now();
            $linkList->updated_at= now();
            $linkList->tool_ID = $tool->id;
            $linkList->save();
        }
        if(count($request->createMoreStudyLabel)>0){
            $studiesCount = count($request->createMoreStudyLabel);
            for( $i = 0; $i <  $studiesCount;$i++){
                $linkList = new linkList;
                $linkList->study_name = ($request->createMoreStudyLabel)[$i];
                $linkList->link = ($request->createLinkLabel)[$i];
                $linkList->created_at= now();
                $linkList->updated_at= now();
                $linkList->tool_ID = $tool->id;
                $linkList->save();
            }
        } 
        
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

         //create connection between user and tool
         $connection = new userCreatesTool;
         $connection->user_ID = 3;
         $connection->tool_ID = $tool->id;
         $connection->save();
 

        $tool->save();

        return redirect('login/tools')->with('message','Successfully Created Tool!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
