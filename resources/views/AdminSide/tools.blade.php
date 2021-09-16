@extends('layouts.adminLayout')

@section('style')
    <style>
        html{
            font-size: 1.2rem;
        }
    </style>
@endsection

@section('nav-bar')
    <a class="nav-link" href="/login/home">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Home
    </a>
    <a class="nav-link  " href="/login/user">
        <div class="sb-nav-link-icon"><i class="fa fa-user-circle"></i></div>
        User Management
    </a> 
    <a class="nav-link bg-primary text-white " href="/login/tools">
        <div class="sb-nav-link-icon"><i class="fa fa-suitcase"></i></div>
        Assessment Tools
    </a> 
    <a class="nav-link" href="/login/request">
        <div class="sb-nav-link-icon"><i class="fa fa-paper-plane"></i></div>
        Tool Request
    </a>
    <a class="nav-link" href="/login/todolist">
        <div class="sb-nav-link-icon"><i class="fa fa-server"></i></div>
        To-do List 
    </a> 
    <a class="nav-link" href="/login/feedback">
        <div class="sb-nav-link-icon"><i class="fa fa-life-ring"></i></div>
        Feedback
    </a> 
    <a class="nav-link" href="/login/draft">
        <div class="sb-nav-link-icon"> <i class="fab fa-firstdraft"></i> </div>
        Draft
    </a>
@endsection

@section('content')
    <main>
        <h1 class="display-5">Assessment Tools</h1>
        <div class="row">
            <!--Add new tool button-->
            <div class="col-sm-3 mb-2">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                data-bs-target="#createToolForm"><i class="fas fa-plus"></i> Add new tool</button>
            </div>

            <div class="col-sm-4"></div>
            <!--Search Bar-->
            <div class="col-sm-5">
                <div class="input-group rounded">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                      aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                      <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>


        <!--Create Modal-->
        <div class="modal fade" id="createToolForm" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="createToolFormLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h1 class="text-white">Add new tool</h1>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="/login/tools" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="container bg-white">
                                    @if ($errors->hasBag('store'))
                                        <div class="alert alert-danger">
                                            @foreach ($errors->store->all() as $error)
                                            <ul>
                                                <li>{{ $error }}</li>
                                            </ul>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="main">
                                        <h2>Tool Details</h2> 
                                        <!--Tool Name-->
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <label for="createToolName" class="col-form-label">Tool Name *</label>
                                            </div>
                                            <div class="col">
                                                <input id="createToolName" name="createToolName" class="form-control" placeholder="Enter your tool name here..." required>
                                            </div>
                                        </div>
                                        
                                        <!--Description-->  
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <label for="createDescription" class="col-form-label">Description *</label>
                                            </div>
                                            <div class="col">
                                                <textarea id="createDescription" name="createDescription" class="form-control" placeholder="Enter your description here..." required></textarea>
                                            </div>
                                        </div>   
                                        <!--Health Domain & Age Group-->
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <label for="createHealthDomain" class="col-form-label">Health Domain *</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="createHealthDomain" name="createHealthDomain"  class="form-select" required>
                                                    <option value="">Choose...</option>
                                                    <option value="Emotional">Emotional</option>
                                                    <option value="Social">Social</option>
                                                    <option value="Physical">Physical</option>
                                                    <option value="Cognitive">Cognitive</option>
                                                    <option value="Spiritual">Spiritual</option>
                                                    <option value="Employment">Employment</option>
                                                </select>    
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-2">
                                                <label for="createAgeGroup" class="col-form-label">Age Group</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="createAgeGroup" name="createAgeGroup" class="form-select" required>
                                                    <option value="All" selected>All</option>
                                                    <option value="0-10 years">0-10 years</option>
                                                    <option value="11-19 years">11-19 years</option>
                                                    <option value="20-29 years">20-29 years</option>
                                                    <option value="30-39 years">30-39 years</option>
                                                    <option value="40-49 years">40-49 years</option>
                                                    <option value="+50 years">+50 years</option>
                                                </select>    
                                            </div>
                                        </div>
                                        
                                        <!--Notes-->
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <label for="createNotes" class="col-form-label">Notes</label>
                                            </div>     
                                            <div class="col-sm-10">
                                                <textarea id="createNotes" name="createNotes" class="form-control" rows="3" placeholder="Write your note here..."></textarea>
                                            </div>
                                        </div>
                    
                                        <!--Link-->
                                        <div class="row mb-3">     
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Study(s) has used this tool</label>
                                            </div>
                                            <div class="col-sm-10" id="studies">
                                                
                                                <div class="row mb-2" >
                                                    <div class="col-sm-6">
                                                        <input id="createStudyLabel" name="createStudyLabel" class="form-control" placeholder="Type the study name">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input id="createLinkLabel" name="createLinkLabel" class="form-control" placeholder="Upload your link here...">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" name="addLink" id="addLink" class="btn btn-primary plus" title="Add more links"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <input type="hidden" value="1" id="total">
                                            
                                        </div>
                    
                                        <!--Attachment-->
                                        <div class="row mb-3">     
                                            <div class="col-sm-2">
                                                <label for="createAttachmentLabel" class="col-form-label">Attachment</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="file" id="createAttachmentLabel" name="createAttachmentLabel" class="form-control">
                                            </div>
                                        </div>
                    
                                        <div class="accordion" id="accordion">
                                            <!--Additional Details-->
                                            <div class="accordion-item">
                                                <h1 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Additional Details
                                                    </button>
                                                </h1>
                                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" >
                                                    <div class="accordion-body">
                                                        <!--Outcome-->
                                                        <div class="row mb-3">
                                                            <div class="col-sm-2">
                                                                <label for="createOutcome" class="col-form-label">Outcome</label>
                                                            </div>
                                                            <div class="col-sm-10">    
                                                                <textarea class="form-control" id="createOutcome" name="createOutcome" rows="2"></textarea>   
                                                            </div>
                                                        </div>
                    
                                                        <!--Gender-->
                                                        <div class="row mb-3">
                                                            <div class="col-sm-2">
                                                                <label for="createGender" class="col-form-label">Gender</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createGender" name="createGender" class="form-select" placeholder="Gender">
                                                                    <option value ="Any" selected>Any</option>
                                                                    <option value ="Female">Female</option>
                                                                    <option value ="Male">Male</option>
                                                                </select>
                                                            </div>
                                                        </div>
                    
                                                        <!--Modality & Condition-->
                                                        <div class="row mb-2">
                                                            <!--Condition-->
                                                            <div class="col-sm-2">
                                                                <label for="createCondition" class="col-form-label"> Health Condition</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createCondition" name="createCondition" class="form-select">
                                                                    <option value="" selected>Choose...</option>
                                                                    <option value="PTSD">PTSD</option>
                                                                    <option value="Mental Health Disorders">Mental Health Disorders</option>
                                                                    <option value="Physical/Development disabilities">Physical/Development disabilities</option>
                                                                    <option value="Substance misuse">Substance misuse</option>
                                                                </select>    
                                                            </div>
                                                            
                                                            <!--Modality-->
                                                            <div class="col-sm-1"></div>
                                                            <div class="col-sm-2">
                                                                <label for="createModality" class="col-form-label">Recreation Modality</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createModality" name="createModality" class="form-select">
                                                                    <option value="" selected>Choose...</option>
                                                                    <option value="Horticulture">Horticulture</option>
                                                                    <option value="Equin Therapy">Equin Therapy</option>
                                                                    <option value="Bush Therapy">Bush Therapy</option>
                                                                    <option value="Therapeutic Recreation">Therapeutic Recreation</option>
                                                                    <option value="Outdoor Adventure">Outdoor Adventure</option>
                                                                </select>    
                                                            </div>
                                                        </div>
                    
                                                        <!--Specific NB & Settings-->
                                                        <div class="row mb-2">
                                                            <!--Specific NB-->
                                                            <div class="col-sm-2">
                                                                <label for="createSpecificNB" class="col-form-label">Specific for Nature Base</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createSpecificNB" name="createSpecificNB" class="form-select">
                                                                    <option value="No" selected>No</option>
                                                                    <option value="Yes">Yes</option>
                                                                    
                                                                </select>   
                                                            </div>
                                                            <div class="col-sm-1"></div>
                                                            <!--Settings-->
                                                            <div class="col-sm-2">
                                                                <label for="createSetting" class="col-form-label" id="createSettingLabel" style="display: none"> Nature Settings</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createSetting" name="createSetting" class="form-select" style="display: none">
                                                                    <option value="" selected>Choose...</option>
                                                                    <option value="Bluespace">Bluespace</option>
                                                                    <option value="Greenspace">Greenspace</option>
                                                                    <option value="Wild Nature">Wild Nature</option>
                                                                    <option value="Camp/Residential">Camp/Residential</option>
                                                                    <option value="Urban Nature">Urban Nature</option>
                                                                </select>    
                                                            </div>
                                                        </div>    
                                                                
                                                        <!--Reliability & Validity-->
                                                        <div class="row mb-3">
                                                            <!--Reliability-->
                                                            <div class="col-sm-2">
                                                                <label for="createReliability" class="col-form-label">Reliability</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input id="createReliability" name="createReliability" class="form-control" placeholder="Reliability">
                                                            </div> 
                                                            <!--Validity-->
                                                            <div class="col-sm-1"></div>
                                                            <div class="col-sm-2">
                                                                <label for="createValidity" class="col-form-label">Validity</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createValidity" name="createValidity" class="form-select">
                                                                    <option value="" selected>Choose...</option>
                                                                    <option value="Validated">Validated</option>
                                                                    <option value="Not Validated">Not Validated</option>
                                                                </select>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!--Journal Details-->
                                            <div class="accordion-item">
                                                <h1 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                        Journal's Details
                                                    </button>
                                                </h1>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <!--Author-->
                                                            <div class="col-sm-2">
                                                                <label for="createAuthor" class="col-form-label">Author</label>
                                                            </div>
                                                            <div class="col-sm-10 mb-3">
                                                                <input id="createAuthor" name="createAuthor" class="form-control" placeholder="Author">
                                                            </div>
                                                            <!--Title-->
                                                            <div class="col-sm-2">
                                                                <label for="createTitle" class="col-form-label">Article Title</label>
                                                            </div>
                                                            <div class="col-sm-10 mb-3">
                                                                <input id="createTitle" name="createTitle" class="form-control" placeholder="Title">
                                                            </div>
                                                            <!--Date-->
                                                            <div class="col-sm-2">
                                                                <label for="createYear" class="col-form-label">Year</label>
                                                            </div>
                                                            <div class="col-sm-3 mb-3">
                                                                <input id="createYear" name="createYear" class="form-control" placeholder="Year">
                                                            </div>
                                                            <div class="col-sm-1"></div>
                                                            <!--Country-->
                                                            <div class="col-sm-1">
                                                                <label for="createCountry" class="col-form-label">Country</label>
                                                            </div>
                                                            <div class="col-sm-3 mb-3">
                                                                <input id="createCountry" name="createCountry" class="form-control" placeholder="Country">
                                                            </div>
                                                        </div>
                                    
                                                        <!--Journal-->    
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <label for="createJournal" class="col-form-label">Journal</label>
                                                            </div>
                                                            <div class="col-sm-10 mb-3">
                                                                <input id="createJournal" name="createJournal" class="form-control" placeholder="Journal">
                                                            </div>
                                                        </div>
                                                        
                                                        <!--Measure-->
                                                        <div class="row mb-3">
                                                            <div class="col-sm-2">
                                                                <label for="createMeasure" class="col-form-label">Measure</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createMeasure" name="createMeasure" class="form-select">
                                                                    <option value="" selected>Choose...</option>
                                                                    <option value="Wellbeing">Wellbeing</option>
                                                                    <option value="Self Determination">Self Determination</option>
                                                                    <option value="Reseliance">Reseliance</option>
                                                                </select>    
                                                            </div>
                                                        </div>
                                                        <!--Program Content-->
                                                        <div class="row mb-3">
                                                            <div class="col-sm-2">
                                                                <label for="createProgramContent" class="col-form-label">Program Content</label>
                                                            </div>
                                                            <div class="col-sm-10" >
                                                                <textarea class="form-control" id="createProgramContent" name="createProgramContent" rows="2"></textarea>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="saveDraft" value="Save" class="btn btn-secondary" data-bs-dismiss="modal">Save as
                                Draft</button>
                            <button type="submit" name="add" value="Submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Create Modal-->

        @if(session('message'))
            <div class="alert alert-success mb-1" role="alert">
                <i class="fas fa-check-circle"></i>
                <strong>
                    {{ session('message')}}            
                </strong>
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!--Table List-->
        <div class="container-fluid p-0">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Health Domain</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                   
               
                @foreach ($tools as $tool)
                     
                    <tr>
                        <th scope="row">{{ $loop->iteration + $tools->firstItem() - 1 }}</th>
                        <td class="col-sm-4">{{ $tool->tool_name }}</td>
                        
                        <td>{{ $tool->health_domain }}</td>
                        
                        <td>
                            <div class="form-check form-switch">
                                @if (!strcmp(($tool->status),'Hidden'))
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" >
                                @else
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                @endif
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
                            </div>
                            
                        </td>
                        <td>
                            <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                            data-bs-target="#detailsToolForm-{{ $tool->id }}">Details</button>

                            <!--Details Modal-->
                            <div class="modal fade" id="detailsToolForm-{{ $tool->id }}" data-bs-backdrop="static" tabindex="-1"
                            aria-labelledby="detailsToolFormLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h1 class="text-white">Details</h1>
                                            <p class="text-white">Status: {{ $tool->status }}</p>
                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        
                                            <div class="modal-body">
                                                <div class="container bg-white">
                                                        <div class="main">
                                                            <h2>Tool Details</h2> 
                                                            <!--Tool Name-->
                                                            <!--<div class="row mb-3">
                                                                <div class="col-sm-12">
                                                                    <label for="createToolName" class="col-form-label"><strong>Tool Name:</strong></label>
                                                                </div>
                                                                <div class="col-sm">
                                                                    
                                                                </div>
                                                            </div>-->
                                                            <div class="row">
                                                                <label for="createToolName" class="col-form-label"><strong>Tool Name: </strong> {{ $tool->tool_name }}</label>
                                                            </div>
                                                            <div class="row">
                                                            <label for="createDescription" class="col-form-label"><strong>Description:</strong> {{ $tool->tool_description }}</label>
                                                            
                                                            </div>
                                                            <!--Description-->  
                                                            <div class="row mb-3">
                                                                <div class="col-sm-2">
                                                                    
                                                                </div>
                                                                <div class="col">
                                                                    
                                                                </div>
                                                            </div>  

                                                            <!--Health Domain & Age Group-->
                                                            <div class="row mb-3">
                                                                
                                                                    <label for="createHealthDomain" class="col-form-label"><strong>Health Domain:</strong>{{ $tool->health_domain }}</label>
                                                                

                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-sm-2">
                                                                    <label for="createAgeGroup" class="col-form-label"><strong>Group:</strong> </label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    {{ $tool->age_group }}   
                                                                </div>
                                                            </div>
                                                            
                                                            <!--Notes-->
                                                            <div class="row mb-3">
                                                                <div class="col-sm-2">
                                                                    <label for="createNotes" class="col-form-label"><strong>Notes:</strong> </label>
                                                                </div>     
                                                                <div class="col">
                                                                    {{ $tool->notes }}
                                                                </div>
                                                            </div>
                                        
                                                            <!--Link-->
                                                            <div class="row mb-3">     
                                                                <div class="col-sm-3">
                                                                    <label class="col-form-label"><strong>Study(s) has used this tool</strong></label>
                                                                </div>
                                                                <div class="col-sm-12" id="studies">
                                                                    <div class="row mb-2">
                                                                        @foreach ($link_lists as $link)
                                                                            @if($link->id == $tool->id)
                                                                                <div class="col-sm-2">{{ $link->study_name }}</div>
                                                                                <div class="col-sm-2 "><a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a></div>
                                                                                <div class="col-sm-8"></div>   
                                                                            @endif    
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                        
                                                            <!--Attachment-->
                                                            <div class="row mb-3">     
                                                                <div class="col-sm-2">
                                                                    <label for="createAttachmentLabel" class="col-form-label"><strong>Attachment:</strong></label>
                                                                </div>
                                                                <div class="col">
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                            <hr>
                                                            <!--Additional Details-->
                                                            <h2>Additional Details</h2>
                                                            
                                                                <!--Outcome-->
                                                                <div class="row mb-3">
                                                                    <div class="col-sm-2">
                                                                        <label for="createOutcome" class="col-form-label"><strong>Outcome:</strong></label>
                                                                    </div>
                                                                    <div class="col">    
                                                                        {{ $tool->outcome }}   
                                                                    </div>
                                                                </div>
                            
                                                                <!--Gender-->
                                                                <div class="row mb-3">
                                                                    <div class="col-sm-2">
                                                                        <label for="createGender" class="col-form-label"><strong>Gender:</strong></label>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{ $tool->gender }}
                                                                    </div>
                                                                </div>
                            
                                                                <!--Modality & Condition-->
                                                                <div class="row mb-2">
                                                                    <!--Condition-->
                                                                    <div class="col-sm-2">
                                                                        <label for="createCondition" class="col-form-label"><strong>Health Condition:</strong></label>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{ $tool->health_condition }}   
                                                                    </div>
                                                                </div>
                                                                
                                                                <!--Modality-->
                                                                <div class="row mb-2">    
                                                                    <div class="col-sm-2">
                                                                        <label for="createModality" class="col-form-label"><strong>Recreation Modality:</strong> </label>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{ $tool->modality }}  
                                                                    </div>
                                                                </div>
                            
                                                                <!--Specific NB & Settings-->
                                                                <div class="row mb-2">
                                                                    <!--Specific NB-->
                                                                    <div class="col-sm-2">
                                                                        <label for="createSpecificNB" class="col-form-label"><strong>Specific for Nature Base:</strong> </label>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{ $tool->specific_NB }} 
                                                                    </div>
                                                                </div>

                                                                <!--Settings-->
                                                                <div class="row mb-2">
                                                                    
                                                                    <div class="col-sm-2">
                                                                        <label for="createSetting" class="col-form-label"><strong> Nature Settings:</strong> </label>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{ $tool->settings }}   
                                                                    </div>
                                                                </div>    
                                                                        
                                                                <!--Reliability & Validity-->
                                                                <div class="row mb-3">
                                                                    <!--Reliability-->
                                                                    <div class="col-sm-2">
                                                                        <label for="createReliability" class="col-form-label"><strong>Reliability:</strong> </label>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{ $tool->reliability }}
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">     
                                                                    <!--Validity-->
                                                                    
                                                                    <div class="col-sm-2">
                                                                        <label for="createValidity" class="col-form-label"><strong>Validity:</strong> </label>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{ $tool->validity }}    
                                                                    </div>
                                                                </div>
                                                            <!--Additional Details-->

                                                            <div class="accordion" id="accordion">
                                                                <!--Journal Details-->
                                                                <div class="accordion-item">
                                                                    <h1 class="accordion-header" id="headingOne">
                                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                        Additional Details
                                                                        </button>
                                                                    </h1>
                                                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" >
                                                                        <div class="accordion-body">
                                                                            <div class="row">
                                                                                <!--Author-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="createAuthor" class="col-form-label"><strong>Author:</strong> </label>
                                                                                </div>
                                                                                <div class="col-sm-10 mb-3">
                                                                                    {{ $tool->author }}
                                                                                </div>
                                                                                <!--Title-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="createTitle" class="col-form-label"><strong>Article Title:</strong> </label>
                                                                                </div>
                                                                                <div class="col-sm-10 mb-3">
                                                                                    {{ $tool->title }}
                                                                                </div>
                                                                                <!--Year-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="createYear" class="col-form-label"><strong>Year:</strong></label>
                                                                                </div>
                                                                                <div class="col-sm-3 mb-3">
                                                                                    {{ $tool->year }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <!--Country-->
                                                                                <div class="col-sm-1">
                                                                                    <label for="createCountry" class="col-form-label"><strong>Country:</strong></label>
                                                                                </div>
                                                                                <div class="col-sm-3 mb-3">
                                                                                    {{ $tool->country }}
                                                                                </div>
                                                                            </div>
                                                                        
                                                        
                                                                            <!--Journal-->    
                                                                            <div class="row">
                                                                                <div class="col-sm-2">
                                                                                    <label for="createJournal" class="col-form-label">Journal: </label>
                                                                                </div>
                                                                                <div class="col-sm-10 mb-3">
                                                                                    {{ $tool->article }}
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <!--Measure-->
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-2">
                                                                                    <label for="createMeasure" class="col-form-label">Measure: </label>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    {{ $tool->measure }}    
                                                                                </div>
                                                                            </div>
                                                                            <!--Program Content-->
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-2">
                                                                                    <label for="createProgramContent" class="col-form-label">Program Content: </label>
                                                                                </div>
                                                                                <div class="col-sm-10" >
                                                                                    {{ $tool->program_content }}   
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                            <!--Details Modal-->

                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#editToolForm-{{ $tool->id }}">Edit</button>

                            <!--Edit Modal-->
                            <div class="modal fade" id="editToolForm-{{ $tool->id }}" data-bs-backdrop="static" tabindex="-1"
                            aria-labelledby="editToolFormLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h1 class="text-white">Edit Current Tool</h1>
                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="/login/tools/{{ $tool->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="container bg-white">
                                                        @if ($errors->hasBag('update'))
                                                            <div class="alert alert-danger">
                                                                @foreach ($errors->store->all() as $error)
                                                                <ul>
                                                                    <li>{{ $error }}</li>
                                                                </ul>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        <div class="main">
                                                            <h2>Tool Details</h2> 
                                                            <!--Tool Name-->
                                                            <div class="row mb-3">
                                                                <div class="col-sm-2">
                                                                    <label for="editToolName" class="col-form-label">Tool Name *</label>
                                                                </div>
                                                                <div class="col">
                                                                    <input name="editToolName" class="form-control" value="{{ $tool->tool_name }}" required>
                                                                </div>
                                                            </div>
                                                            
                                                            <!--Description-->  
                                                            <div class="row mb-3">
                                                                <div class="col-sm-2">
                                                                    <label for="editDescription" class="col-form-label">Description *</label>
                                                                </div>
                                                                <div class="col">
                                                                    <textarea name="editDescription" class="form-control" value="{{ $tool->tool_description }}" required></textarea>
                                                                </div>
                                                            </div>   
                                                            <!--Health Domain & Age Group-->
                                                            <div class="row mb-3">
                                                                <div class="col-sm-2">
                                                                    <label for="editHealthDomain" class="col-form-label">Health Domain *</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <select  name="editHealthDomain"  class="form-select" required>
                                                                        @switch($tool->health_domain)
                                                                            @case("Emotional")
                                                                                <option value="">Choose...</option>
                                                                                <option value="Emotional" selected>Emotional</option>
                                                                                <option value="Social">Social</option>
                                                                                <option value="Physical">Physical</option>
                                                                                <option value="Cognitive">Cognitive</option>
                                                                                <option value="Spiritual">Spiritual</option>
                                                                                <option value="Employment">Employment</option>
                                                                                @break
                                                                            @case("Social")
                                                                                <option value="">Choose...</option>
                                                                                <option value="Emotional">Emotional</option>
                                                                                <option value="Social" selected>Social</option>
                                                                                <option value="Physical">Physical</option>
                                                                                <option value="Cognitive">Cognitive</option>
                                                                                <option value="Spiritual">Spiritual</option>
                                                                                <option value="Employment">Employment</option>
                                                                                @break
                                                                            @case("Physical")
                                                                                <option value="">Choose...</option>
                                                                                <option value="Emotional">Emotional</option>
                                                                                <option value="Social" selected>Social</option>
                                                                                <option value="Physical" selected>Physical</option>
                                                                                <option value="Cognitive">Cognitive</option>
                                                                                <option value="Spiritual">Spiritual</option>
                                                                                <option value="Employment">Employment</option>
                                                                                @break   
                                                                            @case("Cognitive")
                                                                                <option value="">Choose...</option>
                                                                                <option value="Emotional">Emotional</option>
                                                                                <option value="Social" selected>Social</option>
                                                                                <option value="Physical">Physical</option>
                                                                                <option value="Cognitive" selected>Cognitive</option>
                                                                                <option value="Spiritual">Spiritual</option>
                                                                                <option value="Employment">Employment</option>
                                                                                @break
                                                                            @case("Spiritual")
                                                                                <option value="">Choose...</option>
                                                                                <option value="Emotional">Emotional</option>
                                                                                <option value="Social" selected>Social</option>
                                                                                <option value="Physical">Physical</option>
                                                                                <option value="Cognitive">Cognitive</option>
                                                                                <option value="Spiritual" selected>Spiritual</option>
                                                                                <option value="Employment">Employment</option>
                                                                                @break
                                                                            @case("Employment")
                                                                                <option value="">Choose...</option>
                                                                                <option value="Emotional">Emotional</option>
                                                                                <option value="Social" selected>Social</option>
                                                                                <option value="Physical">Physical</option>
                                                                                <option value="Cognitive">Cognitive</option>
                                                                                <option value="Spiritual">Spiritual</option>
                                                                                <option value="Employment" selected>Employment</option>
                                                                                @break     
                                                                        
                                                                            @default                                                                                    
                                                                        @endswitch
                                                                    </select>    
                                                                </div>
                                                                <div class="col-sm-1"></div>
                                                                <div class="col-sm-2">
                                                                    <label for="editAgeGroup" class="col-form-label">Age Group</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <select name="editAgeGroup" class="form-select" required>
                                                                        @switch($tool->age_group)
                                                                            @case("All")
                                                                                <option value="All" selected>All</option>
                                                                                <option value="0-10 years">0-10 years</option>
                                                                                <option value="11-19 years">11-19 years</option>
                                                                                <option value="20-29 years">20-29 years</option>
                                                                                <option value="30-39 years">30-39 years</option>
                                                                                <option value="40-49 years">40-49 years</option>
                                                                                <option value="+50 years">+50 years</option>
                                                                                @break
                                                                            @case("0-10 years")
                                                                                <option value="All" selected>All</option>
                                                                                <option value="0-10 years" selected>0-10 years</option>
                                                                                <option value="11-19 years">11-19 years</option>
                                                                                <option value="20-29 years">20-29 years</option>
                                                                                <option value="30-39 years">30-39 years</option>
                                                                                <option value="40-49 years">40-49 years</option>
                                                                                <option value="+50 years">+50 years</option>
                                                                                @break
                                                                            @case("11-19 years")
                                                                                <option value="All">All</option>
                                                                                <option value="0-10 years">0-10 years</option>
                                                                                <option value="11-19 years" selected>11-19 years</option>
                                                                                <option value="20-29 years">20-29 years</option>
                                                                                <option value="30-39 years">30-39 years</option>
                                                                                <option value="40-49 years">40-49 years</option>
                                                                                <option value="+50 years">+50 years</option>
                                                                                @break
                                                                            @case("20-29 years")
                                                                                <option value="All">All</option>
                                                                                <option value="0-10 years">0-10 years</option>
                                                                                <option value="11-19 years">11-19 years</option>
                                                                                <option value="20-29 years" selected>20-29 years</option>
                                                                                <option value="30-39 years">30-39 years</option>
                                                                                <option value="40-49 years">40-49 years</option>
                                                                                <option value="+50 years">+50 years</option>
                                                                                @break
                                                                            @case("30-39 years")
                                                                                <option value="All">All</option>
                                                                                <option value="0-10 years">0-10 years</option>
                                                                                <option value="11-19 years">11-19 years</option>
                                                                                <option value="20-29 years">20-29 years</option>
                                                                                <option value="30-39 years" selected>30-39 years</option>
                                                                                <option value="40-49 years">40-49 years</option>
                                                                                <option value="+50 years">+50 years</option>
                                                                                @break
                                                                            @case("40-49 years")
                                                                                <option value="All" >All</option>
                                                                                <option value="0-10 years">0-10 years</option>
                                                                                <option value="11-19 years">11-19 years</option>
                                                                                <option value="20-29 years">20-29 years</option>
                                                                                <option value="30-39 years">30-39 years</option>
                                                                                <option value="40-49 years" selected>40-49 years</option>
                                                                                <option value="+50 years">+50 years</option>
                                                                                @break
                                                                            @case("+50 years")
                                                                                <option value="All" >All</option>
                                                                                <option value="0-10 years">0-10 years</option>
                                                                                <option value="11-19 years">11-19 years</option>
                                                                                <option value="20-29 years">20-29 years</option>
                                                                                <option value="30-39 years">30-39 years</option>
                                                                                <option value="40-49 years">40-49 years</option>
                                                                                <option value="+50 years" selected>+50 years</option>
                                                                                @break
                                                                            @default            
                                                                        @endswitch
                                                                        
                                                                    </select>    
                                                                </div>
                                                            </div>
                                                            
                                                            <!--Notes-->
                                                            <div class="row mb-3">
                                                                <div class="col-sm-2">
                                                                    <label for="editNotes" class="col-form-label">Notes</label>
                                                                </div>     
                                                                <div class="col-sm-10">
                                                                    <textarea name="editNotes" class="form-control" rows="3" value="{{ $tool->notes }}"></textarea>
                                                                </div>
                                                            </div>
                                        
                                                            <!--Link-->
                                                            <div class="row mb-3">     
                                                                <div class="col-sm-2">
                                                                    <label class="col-form-label">Study(s) has used this tool</label>
                                                                </div>
                                                                <div class="col-sm-10" id="retrieved_studies">
                                                                    @php
                                                                        $counter_link = 0;
                                                                        $found_link = 0;
                                                                    @endphp
                                                                    @foreach ($link_lists as $link)
                                                                            @if($link->id == $tool->id)
                                                                                @php
                                                                                    $counter_link++;
                                                                                    $found_link = 1;
                                                                                @endphp
                                                                                @if ($counter_link == 1)
                                                                                    <div class="row mb-2" >
                                                                                        <div class="col-sm-6">
                                                                                            <input name="editStudyLabel" class="form-control" value="{{ $link->study_name }}">
                                                                                        </div>
                                                                                        <div class="col-sm-4">
                                                                                            <input name="editLinkLabel" class="form-control" value="{{ $link->link }}">
                                                                                        </div>
                                                                                        <div class="col-sm-1">
                                                                                            <button type="button" name="addLink" class="btn btn-primary edit-plus" title="Add more links"><i class="fas fa-plus"></i></button>
                                                                                        </div> 
                                                                                    </div>
                                                                                @else
                                                                                    <div class="row mb-2" id="editMore_{{ $counter_link }}">
                                                                                        <div class="col-sm-6">
                                                                                            <input name="createMoreStudyLabel[]" class="form-control" value="{{ $link->study_name }}">
                                                                                        </div>
                                                                                        <div class="col-sm-4">
                                                                                            <input name="createMoreLinkLabel[]" class="form-control" value="{{ $link->link }}">
                                                                                        </div>
                                                                                        <div class="col-sm-1">
                                                                                            <button type="button" name="minusLink" class="btn btn-danger edit-minus" title="Delete link"><i class="fas fa-minus"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif      
                                                                            @endif    
                                                                    @endforeach
                                                                    @if($found_link == 0)
                                                                    <div class="row mb-2" >
                                                                        <div class="col-sm-6">
                                                                            <input  name="editStudyLabel" class="form-control" placeholder="Type the study name">
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input name="editLinkLabel" class="form-control" placeholder="Upload the link here...">
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <button type="button" name="addLink"  class="btn btn-primary edit-plus" title="Add more links"><i class="fas fa-plus"></i></button>
                                                                        </div> 
                                                                    </div>          
                                                                    @endif
                                                                </div>
                                                                <input type="hidden" value="{{ $counter_link }}" id="edit_total">
                                                                
                                                            </div>
                                        
                                                            <!--Attachment-->
                                                            <div class="row mb-3">     
                                                                <div class="col-sm-2">
                                                                    <label for="editAttachmentLabel" class="col-form-label">Attachment</label>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <input type="file" name="editAttachmentLabel" class="form-control">
                                                                </div>
                                                            </div>
                                        
                                                            <div class="accordion" id="accordion">
                                                                <!--Additional Details-->
                                                                <div class="accordion-item">
                                                                    <h1 class="accordion-header" id="headingOne">
                                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                        Additional Details
                                                                        </button>
                                                                    </h1>
                                                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" >
                                                                        <div class="accordion-body">
                                                                            <!--Outcome-->
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-2">
                                                                                    <label for="editOutcome" class="col-form-label">Outcome</label>
                                                                                </div>
                                                                                <div class="col-sm-10">    
                                                                                    <textarea class="form-control" name="editOutcome" rows="2"></textarea>   
                                                                                </div>
                                                                            </div>
                                        
                                                                            <!--Gender-->
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-2">
                                                                                    <label for="editGender" class="col-form-label">Gender</label>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <select name="editGender" class="form-select">
                                                                                        <option value ="Any" selected>Any</option>
                                                                                        <option value ="Female">Female</option>
                                                                                        <option value ="Male">Male</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                        
                                                                            <!--Modality & Condition-->
                                                                            <div class="row mb-2">
                                                                                <!--Condition-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="editCondition" class="col-form-label"> Health Condition</label>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <select name="editCondition" class="form-select">
                                                                                        <option value="" selected>Choose...</option>
                                                                                        <option value="PTSD">PTSD</option>
                                                                                        <option value="Mental Health Disorders">Mental Health Disorders</option>
                                                                                        <option value="Physical/Development disabilities">Physical/Development disabilities</option>
                                                                                        <option value="Substance misuse">Substance misuse</option>
                                                                                    </select>    
                                                                                </div>
                                                                                
                                                                                <!--Modality-->
                                                                                <div class="col-sm-1"></div>
                                                                                <div class="col-sm-2">
                                                                                    <label for="editModality" class="col-form-label">Recreation Modality</label>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <select name="editModality" class="form-select">
                                                                                        <option value="" selected>Choose...</option>
                                                                                        <option value="Horticulture">Horticulture</option>
                                                                                        <option value="Equin Therapy">Equin Therapy</option>
                                                                                        <option value="Bush Therapy">Bush Therapy</option>
                                                                                        <option value="Therapeutic Recreation">Therapeutic Recreation</option>
                                                                                        <option value="Outdoor Adventure">Outdoor Adventure</option>
                                                                                    </select>    
                                                                                </div>
                                                                            </div>
                                        
                                                                            <!--Specific NB & Settings-->
                                                                            <div class="row mb-2">
                                                                                <!--Specific NB-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="editSpecificNB" class="col-form-label">Specific for Nature Base</label>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <select name="editSpecificNB" class="form-select">
                                                                                        <option value="No" selected>No</option>
                                                                                        <option value="Yes">Yes</option>
                                                                                        
                                                                                    </select>   
                                                                                </div>
                                                                                <div class="col-sm-1"></div>
                                                                                <!--Settings-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="createSetting" class="col-form-label" id="createSettingLabel" style="display: none"> Nature Settings</label>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <select name="editSetting" class="form-select" style="display: none">
                                                                                        <option value="" selected>Choose...</option>
                                                                                        <option value="Bluespace">Bluespace</option>
                                                                                        <option value="Greenspace">Greenspace</option>
                                                                                        <option value="Wild Nature">Wild Nature</option>
                                                                                        <option value="Camp/Residential">Camp/Residential</option>
                                                                                        <option value="Urban Nature">Urban Nature</option>
                                                                                    </select>    
                                                                                </div>
                                                                            </div>    
                                                                                    
                                                                            <!--Reliability & Validity-->
                                                                            <div class="row mb-3">
                                                                                <!--Reliability-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="editReliability" class="col-form-label">Reliability</label>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <input name="editReliability" class="form-control" placeholder="Reliability">
                                                                                </div> 
                                                                                <!--Validity-->
                                                                                <div class="col-sm-1"></div>
                                                                                <div class="col-sm-2">
                                                                                    <label for="editValidity" class="col-form-label">Validity</label>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <select name="editValidity" class="form-select">
                                                                                        <option value="" selected>Choose...</option>
                                                                                        <option value="Validated">Validated</option>
                                                                                        <option value="Not Validated">Not Validated</option>
                                                                                    </select>    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!--Journal Details-->
                                                                <div class="accordion-item">
                                                                    <h1 class="accordion-header" id="headingTwo">
                                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                            Journal's Details
                                                                        </button>
                                                                    </h1>
                                                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" >
                                                                        <div class="accordion-body">
                                                                            <div class="row">
                                                                                <!--Author-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="editAuthor" class="col-form-label">Author</label>
                                                                                </div>
                                                                                <div class="col-sm-10 mb-3">
                                                                                    <input name="editAuthor" class="form-control" placeholder="Author">
                                                                                </div>
                                                                                <!--Title-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="editTitle" class="col-form-label">Article Title</label>
                                                                                </div>
                                                                                <div class="col-sm-10 mb-3">
                                                                                    <input name="editTitle" class="form-control" placeholder="Title">
                                                                                </div>
                                                                                <!--Date-->
                                                                                <div class="col-sm-2">
                                                                                    <label for="editYear" class="col-form-label">Year</label>
                                                                                </div>
                                                                                <div class="col-sm-3 mb-3">
                                                                                    <input name="editYear" class="form-control" placeholder="Year">
                                                                                </div>
                                                                                <div class="col-sm-1"></div>
                                                                                <!--Country-->
                                                                                <div class="col-sm-1">
                                                                                    <label for="editCountry" class="col-form-label">Country</label>
                                                                                </div>
                                                                                <div class="col-sm-3 mb-3">
                                                                                    <input name="editCountry" class="form-control" placeholder="Country">
                                                                                </div>
                                                                            </div>
                                                        
                                                                            <!--Journal-->    
                                                                            <div class="row">
                                                                                <div class="col-sm-2">
                                                                                    <label for="editJournal" class="col-form-label">Journal</label>
                                                                                </div>
                                                                                <div class="col-sm-10 mb-3">
                                                                                    <input name="editJournal" class="form-control" placeholder="Journal">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <!--Measure-->
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-2">
                                                                                    <label for="editMeasure" class="col-form-label">Measure</label>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <select name="editMeasure" class="form-select">
                                                                                        <option value="" selected>Choose...</option>
                                                                                        <option value="Wellbeing">Wellbeing</option>
                                                                                        <option value="Self Determination">Self Determination</option>
                                                                                        <option value="Reseliance">Reseliance</option>
                                                                                    </select>    
                                                                                </div>
                                                                            </div>
                                                                            <!--Program Content-->
                                                                            <div class="row mb-3">
                                                                                <div class="col-sm-2">
                                                                                    <label for="editProgramContent" class="col-form-label">Program Content</label>
                                                                                </div>
                                                                                <div class="col-sm-10" >
                                                                                    <textarea class="form-control" name="editProgramContent" rows="2"></textarea>   
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="saveDraft" value="Save" class="btn btn-secondary" data-bs-dismiss="modal">Save as
                                                    Draft</button>
                                                <button type="submit" name="add" value="Submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Edit Modal-->


                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-7 offset-sm-5">
                    {{ $tools->links() }}
                </div>    
            </div>
        </div>
        <!--Table List-->
    </main>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $('button.plus').click(function(e) {
                e.preventDefault();

                var counter = parseInt($('#total').val()) + 1;
                $('#total').val(counter);

                var html = '<div class="row mb-2" id="more_'+counter+'" ><div class="col-sm-6"><input name="createMoreStudyLabel[]" class="form-control" placeholder="Type the study name"></div><div class="col-sm-4"><input name="createMoreLinkLabel[]" class="form-control" placeholder="Upload your link here..."></div><div class="col-sm-1"><button type="button" name="minusLink" id="MinusLink" class="btn btn-danger minus" title="Delete link"><i class="fas fa-minus"></i></button></div></div>'
                $('#studies').append(html);
            });

            $(document).on('click','.minus',function(e){ 
                e.preventDefault();
                var counter = $('#total').val();
                if (counter > 1) {
                    console.log("work");
                    $('#more_'+counter).remove();
                    $('#total').val(counter-1);
                }
            });


            $('#createSpecificNB').change(function(e) {
                var selected = $(e.currentTarget).val();
                $('#createSetting').hide();
                $('#createSettingLabel').hide();
                switch(selected){
                    case "Yes":$('#createSetting').show();
                               $('#createSettingLabel').show();
                                break;
                    case "No":$('#createSetting').hide();
                              $('#createSettingLabel').hide();
                             break;
                    default: break;    
                }
            });   
        });
    </script>
    <script type="text/javascript">
        @if (count($errors->store)>0)
        $(function() {
            $('#createToolForm').modal('show');
        });
        @endif
    </script>
<script type="text/javascript">
    $(function() {
        $(document).on('click','.edit-plus',function(e) {
            e.preventDefault();

            var counter = parseInt($('#edit_total').val()) + 1;
            $('#edit_total').val(counter);
            console.log($('#edit_total').val());
            
            var html = '<div class="row mb-2" id="editMore_'+counter+'" ><div class="col-sm-6"><input name="editMoreStudyLabel[]" class="form-control" placeholder="Type the study name"></div><div class="col-sm-4"><input name="editMoreLinkLabel[]" class="form-control" placeholder="Upload your link here..."></div><div class="col-sm-1"><button type="button" name="editMinusLink" class="btn btn-danger edit-minus" title="Delete link"><i class="fas fa-minus"></i></button></div></div>'
            $('#retrieved_studies').append(html);
            console.log($('#edit_total').val());
        });

        $(document).on('click','.edit-minus',function(e){ 
            e.preventDefault();
            var counter = $('#edit_total').val();
            if (counter > 1) {
                console.log("work");
                $('#editMore_'+counter).remove();
                $('#edit_total').val(counter-1);
            }
        });
    });
</script>
    
    
@endsection