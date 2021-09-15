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
                                                <div class="row mb-2">
                                                    <div class="col-sm-6">
                                                        <input id="createStudyLabel" name="createStudyLabel" class="form-control" placeholder="Type the study name">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input id="createLinkLabel" name="createLinkLabel" class="form-control" placeholder="Upload your link here...">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" name="addLink" id="addLink" class="btn btn-primary plus" title="Add more links"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" name="minusLink" id="minusLink" class="btn btn-danger minus" title="Delete link" disabled><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
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
                            data-bs-target="#createToolForm">Details</button>



                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#editToolForm">Edit</button>

                            <!--Create Modal-->
                            <div class="modal fade" id="editToolForm" data-bs-backdrop="static" tabindex="-1"
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
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-6">
                                                                        <input id="createStudyLabel" name="createStudyLabel" class="form-control" placeholder="Type the study name">
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input id="createLinkLabel" name="createLinkLabel" class="form-control" placeholder="Upload your link here...">
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <button type="button" name="addLink" id="addLink" class="btn btn-primary plus" title="Add more links"><i class="fas fa-plus"></i></button>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <button type="button" name="minusLink" id="minusLink" class="btn btn-danger minus" title="Delete link" disabled><i class="fas fa-minus"></i></button>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            
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
                console.log('work');
                e.preventDefault();
                var html = '<div class="row mb-2"><div class="col-sm-6"><input id="createMoreStudyLabel[]" name="createMoreStudyLabel[]" class="form-control" placeholder="Type the study name"></div><div class="col-sm-4"><input id="createMoreLinkLabel[]" name="createMoreLinkLabel[]" class="form-control" placeholder="Upload your link here..."></div>'
                $('#studies').append(html);
                $('button.minus').removeAttr('disabled');
            });

            $('button.minus').click(function (e) {
                e.preventDefault();
                if ($('#studies > div').length > 1) {
                    $('#studies').children().last().remove();
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
    
@endsection