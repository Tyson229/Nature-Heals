@extends('layouts.adminLayout')

@section('style')
    <style>
        html{ font-size: 1.2rem;}
    </style>
@endsection

@section('nav-bar')
    <a class="nav-link" href="/login/home">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Home
    </a>
    @if(Auth::user()->role_ID == 1)
    <a class="nav-link  " href="/login/user">
        <div class="sb-nav-link-icon"><i class="fa fa-user-circle"></i></div>
        User Management
    </a> 
    @endif
    <a class="nav-link " href="/login/tools">
        <div class="sb-nav-link-icon"><i class="fa fa-suitcase"></i></div>
        Assessment Tools
    </a> 
    @if(Auth::user()->role_ID == 1)
    <a class="nav-link  " href="/login/request">
        <div class="sb-nav-link-icon"><i class="fa fa-paper-plane"></i></div>
        Tool Request
    </a>
    @endif
    <a class="nav-link " href="/login/todolist">
        <div class="sb-nav-link-icon"><i class="fa fa-server"></i></div>
        To-do List 
    </a> 
    @if(Auth::user()->role_ID == 1)
    <a class="nav-link " href="/login/feedback">
        <div class="sb-nav-link-icon"><i class="fa fa-life-ring"></i></div>
        Feedback
    </a> 
    @endif
    <a class="nav-link bg-primary text-white" href="/login/draft">
        <div class="sb-nav-link-icon"> <i class="fab fa-firstdraft"></i> </div>
        Draft
    </a>
@endsection

@section('content')
    <main>
        <h1 class="display-5"> Draft</h1>
        <!--Search bar-->
        <div class="row mb-2">
            <div class="col-sm-3">
                
            </div>

            <div class="col-sm-4"></div>
            <!--Search Bar-->
            <div class="col-sm-5">
                <form action="/login/draft" method="GET" role="search">
                    <div class="input-group rounded">
                        <input type="text" class="form-control rounded" name="term" id="term" placeholder="Search"  />
                        <button class="btn btn-secondary" type="submit" title="Search tools">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if(session('message'))
            <div class="alert alert-success mb-1 " role="alert">
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
                        <th scope="col" class="align-middle">#</th>
                        <th scope="col" class="align-middle">Tool Name</th>
                        <th scope="col" class="align-middle">Health Domain</th>
                        <th scope="col" class="align-middle">Creator</th>
                        <th scope="col" class="align-middle">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse ($tools as $tool)
                        <tr>
                            <th scope="row">{{ $loop->iteration + $tools->firstItem() - 1 }}</th>
                            <td class="col-sm-4">{{ $tool->tool_name }}</td>
                            <td class="col-sm-2">{{ $tool->health_domain }}</td>
                            <td class="col-sm-2">{{ $tool->fname }} {{ $tool->lname }}</td>
                            <td>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#requestForm-{{ $tool->id }}">Open</button>
                               
                                <!--Edit Modal-->
                                <div class="modal fade" id="requestForm-{{ $tool->id }}" data-bs-backdrop="static" tabindex="-1"
                                    aria-labelledby="requestFormLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark">
                                                    <h1 class="text-white">Current Draft</h1>
                                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                                                        aria-label="Close" onclick="window.location.reload();"></button>
                                                </div>
                                                <form action="/login/draft/{{ $tool->id }}" method="POST">
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
                                                                            <label for="requestToolName" class="col-form-label">Tool Name *</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <input name="requestToolName" class="form-control" value="{{ $tool->tool_name }}" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <!--Description-->  
                                                                    <div class="row mb-3">
                                                                        <div class="col-sm-2">
                                                                            <label for="requestDescription" class="col-form-label">Description *</label>
                                                                        </div>
                                                                        <div class="col">
                                                                            <textarea rows="5" name="requestDescription" class="form-control" required>{{ $tool->tool_description }}</textarea>
                                                                        </div>
                                                                    </div>   
                                                                    <!--Health Domain & Age Group-->
                                                                    <div class="row mb-3">
                                                                        <div class="col-sm-2">
                                                                            <label for="requestHealthDomain" class="col-form-label">Health Domain *</label>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <select  name="requestHealthDomain"  class="form-select" required>
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
                                                                            <label for="requestAgeGroup" class="col-form-label">Age Group</label>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <select name="requestAgeGroup" class="form-select" required>
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
                                                                            <label for="requestNotes" class="col-form-label">Notes</label>
                                                                        </div>     
                                                                        <div class="col-sm-10">
                                                                            <textarea name="requestNotes" class="form-control" rows="3">{{ $tool->notes }}</textarea>
                                                                        </div>
                                                                    </div>
                                                
                                                                    <!--Link-->
                                                                    <div class="row mb-3">     
                                                                        <div class="col-sm-2">
                                                                            <label class="col-form-label">Study(s) has used this tool</label>
                                                                        </div>
                                                                        <div class="col-sm-10" id="retrieved_studies-{{ $tool->id }}">
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
                                                                                                    <input name="requestStudyLabel-{{ $tool->id }}" class="form-control" value="{{ $link->study_name }}">
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <input name="requestLinkLabel-{{ $tool->id }}" class="form-control" value="{{ $link->link }}">
                                                                                                </div>
                                                                                                <div class="col-sm-1">
                                                                                                    <button type="button" name="addLink" class="btn btn-primary request-plus" id="requestPlus-{{ $tool->id }}" onclick="requestPlus(this)" title="Add more links"><i class="fas fa-plus"></i></button>
                                                                                                </div> 
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="row mb-2" id="requestMore_{{ $counter_link }}_{{ $tool->id }}">
                                                                                                <div class="col-sm-6">
                                                                                                    <input name="requestMoreStudyLabel-{{ $tool->id }}[]" class="form-control" value="{{ $link->study_name }}">
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <input name="requestMoreLinkLabel-{{ $tool->id }}[]" class="form-control" value="{{ $link->link }}">
                                                                                                </div>
                                                                                                <div class="col-sm-1">
                                                                                                    <button type="button" name="minusLink" class="btn btn-danger request-minus" id="requestMinus-{{ $counter_link }}-{{ $tool->id }}" onclick="requestMinus(this)" title="Delete link"><i class="fas fa-minus"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif      
                                                                                    @endif

                                                                            @endforeach
                                                                            @if($found_link == 0)
                                                                            <div class="row mb-2" >
                                                                                <div class="col-sm-6">
                                                                                    <input  name="requestStudyLabel-{{ $tool->id }}" class="form-control" placeholder="Type the study name">
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <input name="requestLinkLabel-{{ $tool->id }}" class="form-control" placeholder="Upload the link here...">
                                                                                </div>
                                                                                <div class="col-sm-1">
                                                                                    <button type="button" name="addLink" id="requestPlus-{{ $tool->id }}" onclick="requestPlus(this)"  class="btn btn-primary request-plus" title="Add more links"><i class="fas fa-plus"></i></button>
                                                                                </div> 
                                                                            </div>          
                                                                            @endif
                                                                        </div>
                                                                        <input type="hidden" value="{{ $counter_link }}" id="request_total-{{  $tool->id }}">
                                                                        
                                                                    </div>
                                                
                                                                    <!--Attachment-->
                                                                    <div class="row mb-3">     
                                                                        <div class="col-sm-2">
                                                                            <label for="requestAttachmentLabel" class="col-form-label">Attachment</label>
                                                                        </div>
                                                                        <div class="col-sm-10">
                                                                            <input type="file" name="requestAttachmentLabel" class="form-control">
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
                                                                                            <label for="requestOutcome" class="col-form-label">Outcome</label>
                                                                                        </div>
                                                                                        <div class="col-sm-10">    
                                                                                            <textarea class="form-control" name="requestOutcome" rows="2">{{ $tool->outcome }}</textarea>   
                                                                                        </div>
                                                                                    </div>
                                                
                                                                                    <!--Gender-->
                                                                                    <div class="row mb-3">
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestGender" class="col-form-label">Gender</label>
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            @switch($tool->gender)
                                                                                                @case("Any")
                                                                                                    <select name="requestGender" class="form-select">
                                                                                                        <option value ="Any" selected>Any</option>
                                                                                                        <option value ="Female">Female</option>
                                                                                                        <option value ="Male">Male</option>
                                                                                                    </select>
                                                                                                    @break
                                                                                                @case("Female")
                                                                                                    <select name="requestGender" class="form-select">
                                                                                                        <option value ="Any" >Any</option>
                                                                                                        <option value ="Female" selected>Female</option>
                                                                                                        <option value ="Male">Male</option>
                                                                                                    </select>    
                                                                                                    @break
                                                                                                @case("Male")
                                                                                                    <select name="requestGender" class="form-select">
                                                                                                        <option value ="Any" >Any</option>
                                                                                                        <option value ="Female" >Female</option>
                                                                                                        <option value ="Male" selected>Male</option>
                                                                                                    </select>       
                                                                                                @default     
                                                                                            @endswitch
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                
                                                                                    <!--Modality & Condition-->
                                                                                    <div class="row mb-2">
                                                                                        <!--Condition-->
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestCondition" class="col-form-label"> Health Condition</label>
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            @switch($tool->health_condition)
                                                                                                @case(Null)
                                                                                                    <select name="requestCondition" class="form-select">
                                                                                                        <option value="" selected>Choose...</option>
                                                                                                        <option value="PTSD">PTSD</option>
                                                                                                        <option value="Mental Health Disorders">Mental Health Disorders</option>
                                                                                                        <option value="Physical/Development disabilities">Physical/Development disabilities</option>
                                                                                                        <option value="Substance misuse">Substance misuse</option>
                                                                                                    </select>    
                                                                                                    @break
                                                                                                @case("PTSD")
                                                                                                <select name="requestCondition" class="form-select">
                                                                                                    <option value="" >Choose...</option>
                                                                                                    <option value="PTSD" selected>PTSD</option>
                                                                                                    <option value="Mental Health Disorders">Mental Health Disorders</option>
                                                                                                    <option value="Physical/Development disabilities">Physical/Development disabilities</option>
                                                                                                    <option value="Substance misuse">Substance misuse</option>
                                                                                                </select>
                                                                                                @break    
                                                                                                @case("Mental Health Disorders")
                                                                                                <select name="requestCondition" class="form-select">
                                                                                                    <option value="" >Choose...</option>
                                                                                                    <option value="PTSD">PTSD</option>
                                                                                                    <option value="Mental Health Disorders" selected>Mental Health Disorders</option>
                                                                                                    <option value="Physical/Development disabilities">Physical/Development disabilities</option>
                                                                                                    <option value="Substance misuse">Substance misuse</option>
                                                                                                </select>
                                                                                                @break
                                                                                                @case("Physical/Development disabilities")
                                                                                                <select name="requestCondition" class="form-select">
                                                                                                    <option value="" >Choose...</option>
                                                                                                    <option value="PTSD">PTSD</option>
                                                                                                    <option value="Mental Health Disorders">Mental Health Disorders</option>
                                                                                                    <option value="Physical/Development disabilities" selected>Physical/Development disabilities</option>
                                                                                                    <option value="Substance misuse">Substance misuse</option>
                                                                                                </select>
                                                                                                @break
                                                                                                @case("Substance misuse")
                                                                                                <select name="requestCondition" class="form-select">
                                                                                                    <option value="" >Choose...</option>
                                                                                                    <option value="PTSD">PTSD</option>
                                                                                                    <option value="Mental Health Disorders">Mental Health Disorders</option>
                                                                                                    <option value="Physical/Development disabilities">Physical/Development disabilities</option>
                                                                                                    <option value="Substance misuse" selected>Substance misuse</option>
                                                                                                </select>
                                                                                                @break
                                                                                                @default
                                                                                                    
                                                                                            @endswitch
                                                                                        </div>    
                                                                                        
                                                                                        <!--Modality-->
                                                                                        <div class="col-sm-1"></div>
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestModality" class="col-form-label">Recreation Modality</label>
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            @switch($tool->modality)
                                                                                                @case(Null)
                                                                                                    <select name="requestModality" class="form-select">
                                                                                                        <option value="" selected>Choose...</option>
                                                                                                        <option value="Horticulture">Horticulture</option>
                                                                                                        <option value="Equin Therapy">Equin Therapy</option>
                                                                                                        <option value="Bush Therapy">Bush Therapy</option>
                                                                                                        <option value="Therapeutic Recreation">Therapeutic Recreation</option>
                                                                                                        <option value="Outdoor Adventure">Outdoor Adventure</option>
                                                                                                    </select>
                                                                                                    @break
                                                                                                @case("Horticulture")
                                                                                                    <select name="requestModality" class="form-select">
                                                                                                        <option value="" >Choose...</option>
                                                                                                        <option value="Horticulture" selected>Horticulture</option>
                                                                                                        <option value="Equin Therapy">Equin Therapy</option>
                                                                                                        <option value="Bush Therapy">Bush Therapy</option>
                                                                                                        <option value="Therapeutic Recreation">Therapeutic Recreation</option>
                                                                                                        <option value="Outdoor Adventure">Outdoor Adventure</option>
                                                                                                    </select>
                                                                                                    @break
                                                                                                @case("Equin Therapy")
                                                                                                    <select name="requestModality" class="form-select">
                                                                                                        <option value="" >Choose...</option>
                                                                                                        <option value="Horticulture">Horticulture</option>
                                                                                                        <option value="Equin Therapy" selected>Equin Therapy</option>
                                                                                                        <option value="Bush Therapy">Bush Therapy</option>
                                                                                                        <option value="Therapeutic Recreation">Therapeutic Recreation</option>
                                                                                                        <option value="Outdoor Adventure">Outdoor Adventure</option>
                                                                                                    </select>
                                                                                                    @break
                                                                                                @case("Bush Therapy")
                                                                                                    <select name="requestModality" class="form-select">
                                                                                                        <option value="" >Choose...</option>
                                                                                                        <option value="Horticulture">Horticulture</option>
                                                                                                        <option value="Equin Therapy">Equin Therapy</option>
                                                                                                        <option value="Bush Therapy" selected>Bush Therapy</option>
                                                                                                        <option value="Therapeutic Recreation">Therapeutic Recreation</option>
                                                                                                        <option value="Outdoor Adventure">Outdoor Adventure</option>
                                                                                                    </select>
                                                                                                    @break
                                                                                                @case("Therapeutic Recreation")
                                                                                                    <select name="requestModality" class="form-select">
                                                                                                        <option value="" >Choose...</option>
                                                                                                        <option value="Horticulture">Horticulture</option>
                                                                                                        <option value="Equin Therapy">Equin Therapy</option>
                                                                                                        <option value="Bush Therapy">Bush Therapy</option>
                                                                                                        <option value="Therapeutic Recreation" selected>Therapeutic Recreation</option>
                                                                                                        <option value="Outdoor Adventure">Outdoor Adventure</option>
                                                                                                    </select>
                                                                                                    @break
                                                                                                @case("Outdoor Adventure")
                                                                                                    <select name="requestModality" class="form-select">
                                                                                                        <option value="" >Choose...</option>
                                                                                                        <option value="Horticulture">Horticulture</option>
                                                                                                        <option value="Equin Therapy">Equin Therapy</option>
                                                                                                        <option value="Bush Therapy">Bush Therapy</option>
                                                                                                        <option value="Therapeutic Recreation">Therapeutic Recreation</option>
                                                                                                        <option value="Outdoor Adventure" selected>Outdoor Adventure</option>
                                                                                                    </select>
                                                                                                    @break        
                                                                                                @default
                                                                                                    
                                                                                            @endswitch
                                                                                                
                                                                                        </div>
                                                                                    </div>
                                                
                                                                                    <!--Specific NB & Settings-->
                                                                                    <div class="row mb-2">
                                                                                        <!--Specific NB-->
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestSpecificNB" class="col-form-label">Specific for Nature Base</label>
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <select name="requestSpecificNB" class="form-select">
                                                                                                @switch($tool->specific_NB)
                                                                                                    @case("Yes")
                                                                                                        <option value="No">No</option>
                                                                                                        <option value="Yes" selected>Yes</option>
                                                                                                        @break
        
                                                                                                    @default
                                                                                                        <option value="No" selected>No</option>
                                                                                                        <option value="Yes">Yes</option>
                                                                                                @endswitch  
                                                                                            </select>   
                                                                                        </div>
                                                                                        <div class="col-sm-1"></div>
                                                                                        <!--Settings-->
                                                                                        @switch($tool->specific_NB)
                                                                                            @case("Yes")
                                                                                                <div class="col-sm-2">
                                                                                                    <label for="createSetting" class="col-form-label" id="createSettingLabel"> Nature Settings</label>
                                                                                                </div>
                                                                                                <div class="col-sm-3">
                                                                                                    <select name="requestSetting" class="form-select">
                                                                                                        @switch($tool->settings)
                                                                                                            @case("Bluespace")
                                                                                                                <option value="" >Choose...</option>
                                                                                                                <option value="Bluespace" selected>Bluespace</option>
                                                                                                                <option value="Greenspace">Greenspace</option>
                                                                                                                <option value="Wild Nature">Wild Nature</option>
                                                                                                                <option value="Camp/Residential">Camp/Residential</option>
                                                                                                                <option value="Urban Nature">Urban Nature</option>
                                                                                                                @break
                                                                                                            @case("Greenspace")    
                                                                                                                <option value="" >Choose...</option>
                                                                                                                <option value="Bluespace" >Bluespace</option>
                                                                                                                <option value="Greenspace"selected>Greenspace</option>
                                                                                                                <option value="Wild Nature">Wild Nature</option>
                                                                                                                <option value="Camp/Residential">Camp/Residential</option>
                                                                                                                <option value="Urban Nature">Urban Nature</option>
                                                                                                                @break
                                                                                                            @case("Wild Nature")    
                                                                                                                <option value="" >Choose...</option>
                                                                                                                <option value="Bluespace" >Bluespace</option>
                                                                                                                <option value="Greenspace">Greenspace</option>
                                                                                                                <option value="Wild Nature" selected>Wild Nature</option>
                                                                                                                <option value="Camp/Residential">Camp/Residential</option>
                                                                                                                <option value="Urban Nature">Urban Nature</option>
                                                                                                                @break
                                                                                                            @case("Camp/Residential")    
                                                                                                                <option value="" >Choose...</option>
                                                                                                                <option value="Bluespace" >Bluespace</option>
                                                                                                                <option value="Greenspace">Greenspace</option>
                                                                                                                <option value="Wild Nature">Wild Nature</option>
                                                                                                                <option value="Camp/Residential"selected>Camp/Residential</option>
                                                                                                                <option value="Urban Nature">Urban Nature</option>
                                                                                                                @break
                                                                                                            @case("Urban Nature")    
                                                                                                                <option value="" >Choose...</option>
                                                                                                                <option value="Bluespace" >Bluespace</option>
                                                                                                                <option value="Greenspace">Greenspace</option>
                                                                                                                <option value="Wild Nature">Wild Nature</option>
                                                                                                                <option value="Camp/Residential">Camp/Residential</option>
                                                                                                                <option value="Urban Nature" selected>Urban Nature</option>
                                                                                                                @break
                                                                                                            @default
                                                                                                                <option value="" selected>Choose...</option>
                                                                                                                <option value="Bluespace">Bluespace</option>
                                                                                                                <option value="Greenspace">Greenspace</option>
                                                                                                                <option value="Wild Nature">Wild Nature</option>
                                                                                                                <option value="Camp/Residential">Camp/Residential</option>
                                                                                                                <option value="Urban Nature">Urban Nature</option> 
                                                                                                        @endswitch
                                                                                                        
                                                                                                    </select>    
                                                                                                </div>
                                                                                                @break
                                                                                                
                                                                                            @default
                                                                                                <div class="col-sm-2">
                                                                                                    <label for="createSetting" class="col-form-label" id="createSettingLabel" style="display: none"> Nature Settings</label>
                                                                                                </div>
                                                                                                <div class="col-sm-3">
                                                                                                    <select name="requestSetting" class="form-select" style="display: none">
                                                                                                        <option value="" selected>Choose...</option>
                                                                                                        <option value="Bluespace">Bluespace</option>
                                                                                                        <option value="Greenspace">Greenspace</option>
                                                                                                        <option value="Wild Nature">Wild Nature</option>
                                                                                                        <option value="Camp/Residential">Camp/Residential</option>
                                                                                                        <option value="Urban Nature">Urban Nature</option>
                                                                                                    </select>    
                                                                                                </div> 
                                                                                        @endswitch
                                                                                    </div>    
                                                                                            
                                                                                    <!--Reliability & Validity-->
                                                                                    <div class="row mb-3">
                                                                                        <!--Reliability-->
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestReliability" class="col-form-label">Reliability</label>
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <input name="requestReliability" class="form-control" value="{{ $tool->reliability }}">
                                                                                        </div> 
                                                                                        <!--Validity-->
                                                                                        <div class="col-sm-1"></div>
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestValidity" class="col-form-label">Validity</label>
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <select name="requestValidity" class="form-select">
                                                                                                @switch($tool->validity)
                                                                                                    @case("Validated")
                                                                                                        <option value="" >Choose...</option>
                                                                                                        <option value="Validated" selected>Validated</option>
                                                                                                        <option value="Not Validated">Not Validated</option>
                                                                                                        @break
                                                                                                    @case("Not Validated")
                                                                                                        <option value="" >Choose...</option>
                                                                                                        <option value="Validated">Validated</option>
                                                                                                        <option value="Not Validated" selected>Not Validated</option>
                                                                                                        @break
                                                                                                    @default
                                                                                                        <option value="" selected >Choose...</option>
                                                                                                        <option value="Validated">Validated</option>
                                                                                                        <option value="Not Validated" >Not Validated</option>
                                                                                                @endswitch
                                                                                                
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
                                                                                            <label for="requestAuthor" class="col-form-label">Author</label>
                                                                                        </div>
                                                                                        <div class="col-sm-10 mb-3">
                                                                                            <input name="requestAuthor" class="form-control" value="{{ $tool->author }}">
                                                                                        </div>
                                                                                        <!--Title-->
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestTitle" class="col-form-label">Article Title</label>
                                                                                        </div>
                                                                                        <div class="col-sm-10 mb-3">
                                                                                            <input name="requestTitle" class="form-control" value="{{ $tool->title }}">
                                                                                        </div>
                                                                                        <!--Date-->
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestYear" class="col-form-label">Year</label>
                                                                                        </div>
                                                                                        <div class="col-sm-3 mb-3">
                                                                                            <input name="requestYear" class="form-control" value="{{ $tool->year }}">
                                                                                        </div>
                                                                                        <div class="col-sm-1"></div>
                                                                                        <!--Country-->
                                                                                        <div class="col-sm-1">
                                                                                            <label for="requestCountry" class="col-form-label">Country</label>
                                                                                        </div>
                                                                                        <div class="col-sm-3 mb-3">
                                                                                            <input name="requestCountry" class="form-control" value="{{ $tool->country }}">
                                                                                        </div>
                                                                                    </div>
                                                                
                                                                                    <!--Journal-->    
                                                                                    <div class="row">
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestJournal" class="col-form-label">Journal</label>
                                                                                        </div>
                                                                                        <div class="col-sm-10 mb-3">
                                                                                            <input name="requestJournal" class="form-control" value="{{ $tool->article }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                    <!--Measure-->
                                                                                    <div class="row mb-3">
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestMeasure" class="col-form-label">Measure</label>
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <select name="requestMeasure" class="form-select">
                                                                                                @switch($tool->measure)
                                                                                                    @case("Wellbeing")
                                                                                                        <option value="" selected>Choose...</option>
                                                                                                        <option value="Wellbeing">Wellbeing</option>
                                                                                                        <option value="Self Determination">Self Determination</option>
                                                                                                        <option value="Reseliance">Reseliance</option>
                                                                                                        @break
                                                                                                    @case("Self Determination")
                                                                                                        <option value="" >Choose...</option>
                                                                                                        <option value="Wellbeing">Wellbeing</option>
                                                                                                        <option value="Self Determination"selected>Self Determination</option>
                                                                                                        <option value="Reseliance">Reseliance</option>
                                                                                                        @break
                                                                                                    @case("Reseliance")
                                                                                                        <option value="" >Choose...</option>
                                                                                                        <option value="Wellbeing">Wellbeing</option>
                                                                                                        <option value="Self Determination">Self Determination</option>
                                                                                                        <option value="Reseliance" selected>Reseliance</option>
                                                                                                        @break
                                                                                                    @default
                                                                                                        <option value="" selected>Choose...</option>
                                                                                                        <option value="Wellbeing">Wellbeing</option>
                                                                                                        <option value="Self Determination">Self Determination</option>
                                                                                                        <option value="Reseliance">Reseliance</option>
                                                                                                @endswitch
                                                                                                
                                                                                            </select>    
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--Program Content-->
                                                                                    <div class="row mb-3">
                                                                                        <div class="col-sm-2">
                                                                                            <label for="requestProgramContent" class="col-form-label">Program Content</label>
                                                                                        </div>
                                                                                        <div class="col-sm-10" >
                                                                                            <textarea class="form-control" name="requestProgramContent" rows="2">{{ $tool->program_content }}</textarea>   
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
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">Cancel</button>
                                                        <button type="submit" name="draft" value="Submit" class="btn btn-secondary">
                                                            Save as Draft
                                                        </button>
                                                        <button type="submit" name="save" value="Submit" class="btn btn-primary">
                                                            @if (Auth::user()->role_ID==1)
                                                                Save
                                                            @else
                                                                Submit 
                                                            @endif
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                </div>
                                <!--Edit Modal-->

                                <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                data-bs-target="#deleteRequestForm-{{ $tool->id }}">Delete</button>
                                <!--Delete Modal-->
                                <div class="modal fade" id="deleteRequestForm-{{ $tool->id }}" tabindex="-1" aria-labelledby="deleteRequestFormLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger" >
                                                <h1 class="text-white display-6">Are you sure?</h1>
                                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/login/draft/{{ $tool->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            <div class="modal-body">
                                                <div class="container bg-white">
                                                    <div class="row">
                                                    All information of this request will be deleted. Are you sure?
                                                    </div>   
                                                </div>
                                            </div> 
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-secondary" value="Submit">Yes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--Delete Modal-->

                            </td>     
                        </tr> 
                    @empty
                        <tr><td colspan="5" class="text-center">No Records Found</td></tr>
                    @endforelse
                </tbody>
                <div class="row">
                    <div class="col-sm-7 offset-sm-5">
                        {{ $tools->links() }}
                    </div>    
                </div>
            </table>
        </div>
        <!--Table List-->
    
    </main>
@endsection

@section('script')
    <script type="text/javascript">
        @if (count($errors->update)>0)
        $(function() {
            $('#requestForm-'+{{ session('id')}}).modal('show');
        });
        @endif
    </script>

    <script type="text/javascript">
        function requestPlus(e) {
            
            var button = e.id;
            
            var buttonID = button.split('-'); // editplus-26 by running split we have created an array [editPlus, 26]
            
            var requestTotal = '#request_total-'+buttonID[1]; // gotten 26 from the edit button name
            var counter = parseInt($(requestTotal).val()) + 1; // creating the name #edit_total-26
            $(requestTotal).val(counter);

            var additionalLink = "requestMore_"+counter+"_"+buttonID[1];

            var html = '<div class="row mb-2" id="'+additionalLink+'" ><div class="col-sm-6"><input name="requestMoreStudyLabel-'+buttonID[1]+'[]" class="form-control" placeholder="Type the study name"></div><div class="col-sm-4"><input name="requestMoreLinkLabel-'+buttonID[1]+'[]" class="form-control" placeholder="Upload your link here..."></div><div class="col-sm-1"><button type="button" id="requestMinus-'+counter+'-'+buttonID[1]+'" onclick="requestMinus(this)" name="requestMinusLink-'+buttonID[1]+'" class="btn btn-danger request-minus" title="Delete link"><i class="fas fa-minus"></i></button></div></div>';

            $('#retrieved_studies-'+buttonID[1]).append(html);
            console.log($(requestTotal).val());
        }

        function requestMinus(e){
            var button = e.id;
            var buttonID = button.split('-');
            var requestTotal = '#request_total-'+buttonID[2];

            console.log(button);
            var counter = $(requestTotal).val();
            if (counter > 1) {
                console.log("work");
                $('#requestMore_'+buttonID[1]+"_"+buttonID[2]).remove();
                //$(editTotal).val(counter-1);
            }
        }    

    </script> 
@endsection