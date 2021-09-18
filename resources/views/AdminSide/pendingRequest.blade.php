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
    <a class="nav-link bg-primary text-white " href="/login/request">
        <div class="sb-nav-link-icon"><i class="fa fa-paper-plane"></i></div>
         Tool Request
    </a>
    @endif
    <a class="nav-link" href="/login/todolist">
        <div class="sb-nav-link-icon"><i class="fa fa-server"></i></div>
        To-do List 
    </a> 
    @if(Auth::user()->role_ID == 1)
    <a class="nav-link" href="/login/feedback">
        <div class="sb-nav-link-icon"><i class="fa fa-life-ring"></i></div>
        Feedback
    </a> 
    @endif
    <a class="nav-link" href="/login/draft">
        <div class="sb-nav-link-icon"> <i class="fab fa-firstdraft"></i> </div>
        Draft
    </a>
@endsection

@section('content')
    <main>
        <h1 class="display-5"> Tool Request</h1>

        <!--Modal-->
        <div class="modal fade" id="createToolForm" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="createToolFormLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h1 class="text-white">Add new tool</h1>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container bg-white">
                            <form>
                                <div class="main">
                                    <h2>Tool Details</h2> 
                                    <!--Tool Name-->
                                    <div class="row mb-3">
                                        <div class="col-sm-2">
                                            <label for="toolName" class="col-form-label">Tool Name</label>
                                        </div>
                                        <div class="col">
                                            <input id="toolName" class="form-control" placeholder="Enter your tool name here..." required>
                                        </div>
                                    </div>
                                    
                                    <!--Description-->  
                                    <div class="row mb-3">
                                        <div class="col-sm-2">
                                            <label for="description" class="col-form-label">Description</label>
                                        </div>
                                        <div class="col">
                                            <textarea id="description" class="form-control" placeholder="Enter your description here..."></textarea>
                                        </div>
                                    </div>   
                                    <!--Health Domain & Age Group-->
                                    <div class="row mb-3">
                                        <div class="col-sm-2">
                                            <label for="healthDomainLabel" class="col-form-label">Health Domain</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="healthDomainLabel" class="form-select">
                                                <option selected>Choose...</option>
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
                                            <label for="ageGroupLabel" class="col-form-label">Age Group</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="ageGroupLabel" class="form-select">
                                                <option selected>Choose...</option>
                                                <option value="1">Child 0-11</option>
                                                <option value="2">Youth 12-17</option>
                                                <option value="3">Young Adult 18-25</option>
                                                <option value="4">Senior 55 and over</option>
                                                <option value="5">All</option>
                                            </select>    
                                        </div>
                                    </div>
                                    
                                    <!--Notes-->
                                    <div class="row mb-3">
                                        <div class="col-sm-2">
                                            <label for="notesLabel" class="col-form-label">Notes</label>
                                        </div>     
                                        <div class="col-sm-10">
                                            <textarea id="notesLabel" class="form-control" rows="3" placeholder="Write your note here..."></textarea>
                                        </div>
                                    </div>
                
                                    <!--Link-->
                                    <div class="row mb-3">     
                                        <div class="col-sm-2">
                                            <label for="linkLabel" class="col-form-label">Link</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input id="linkLabel" class="form-control" placeholder="Upload your link here...">
                                        </div>
                                    </div>
                
                                    <!--Attachment-->
                                    <div class="row mb-3">     
                                        <div class="col-sm-2">
                                        <label for="attachmentLabel" class="col-form-label">Attachment</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="file" id="attachmentsLabel" class="form-control">
                                    </div>
                                    </div>
                
                                    <div class="accordion" id="accordion">
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
                                                            <label for="outcome" class="col-form-label">Outcome</label>
                                                        </div>
                                                        <div class="col-sm-10">    
                                                            <textarea class="form-control" id="outcome" rows="2"></textarea>   
                                                        </div>
                                                    </div>
                
                                                    <!--Gender-->
                                                    <div class="row mb-3">
                                                        <div class="col-sm-2">
                                                            <label for="genderLabel" class="col-form-label">Gender</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input id="genderLabel" class="form-control" placeholder="Gender">
                                                        </div>
                                                    </div>
                
                                                    <!--Modality & Condition-->
                                                    <div class="row mb-2">
                                                        <!--Condition-->
                                                        <div class="col-sm-2">
                                                            <label for="condition" class="col-form-label"> Health Condition</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select id="condition" class="form-select">
                                                                <option selected>Choose...</option>
                                                                <option value="1">PTSD</option>
                                                                <option value="2">Mental Health Disorders</option>
                                                                <option value="3">Physical/Development disabilities</option>
                                                                <option value="4">Substance misuse</option>
                                                            </select>    
                                                        </div>
                                                        
                                                        <!--Modality-->
                                                        <div class="col-sm-1"></div>
                                                        <div class="col-sm-2">
                                                            <label for="modality" class="col-form-label">Recreation Modality</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select id="modality" class="form-select">
                                                                <option selected>Choose...</option>
                                                                <option value="1">Horticulture</option>
                                                                <option value="2">Equin Therapy</option>
                                                                <option value="3">Bush Therapy</option>
                                                                <option value="4">Therapeutic Recreation</option>
                                                                <option value="5">Outdoor Adventure</option>
                                                            </select>    
                                                        </div>
                                                    </div>
                
                                                    <!--Specific NB & Settings-->
                                                    <div class="row mb-2">
                                                        <!--Specific NB-->
                                                        <div class="col-sm-2">
                                                            <label for="specificNB" class="col-form-label">Specific for Nature Base</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select id="specificNB" class="form-select">
                                                                <option selected>Choose...</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>   
                                                        </div>
                                                        <div class="col-sm-1"></div>
                                                        <!--Settings-->
                                                        <div class="col-sm-2">
                                                            <label for="settingLabel" class="col-form-label"> Nature Settings</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select id="settingLabel" class="form-select">
                                                                <option selected>Choose...</option>
                                                                <option value="1">Bluespace</option>
                                                                <option value="2">Greenspace</option>
                                                                <option value="3">Wild Nature</option>
                                                                <option value="4">Camp/Residential</option>
                                                                <option value="5">Urban Nature</option>
                                                            </select>    
                                                        </div>
                                                    </div>    
                                                            
                                                    <!--Reliability & Validity-->
                                                    <div class="row mb-3">
                                                        <!--Reliability-->
                                                        <div class="col-sm-2">
                                                            <label for="reliability" class="col-form-label">Reliability</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input id="reliability" class="form-control" placeholder="Reliability">
                                                        </div> 
                                                        <!--Validity-->
                                                        <div class="col-sm-1"></div>
                                                        <div class="col-sm-2">
                                                            <label for="validity" class="col-form-label">Validity</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select id="validity" class="form-select">
                                                                <option selected>Choose...</option>
                                                                <option value="Validated">Validate</option>
                                                                <option value="Not Validated">Not Validated</option>
                                                            </select>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="accordion-item">
                                            <h1 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                    Author of the Journal
                                                </button>
                                            </h1>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <!--Author-->
                                                        <div class="col-sm-2">
                                                            <label for="authorLabel" class="col-form-label">Author</label>
                                                        </div>
                                                        <div class="col-sm-10 mb-3">
                                                            <input id="authorLabel" class="form-control" placeholder="Author">
                                                        </div>
                                                        <!--Title-->
                                                        <div class="col-sm-2">
                                                            <label for="titleLabel" class="col-form-label">Title</label>
                                                        </div>
                                                        <div class="col-sm-10 mb-3">
                                                            <input id="titleLabel" class="form-control" placeholder="Title">
                                                        </div>
                                                        <!--Date-->
                                                        <div class="col-sm-2">
                                                            <label for="dateLabel" class="col-form-label">Date</label>
                                                        </div>
                                                        <div class="col-sm-3 mb-3">
                                                            <input id="dateLabel" class="form-control" placeholder="Date">
                                                        </div>
                                                        <div class="col-sm-1"></div>
                                                        <!--Country-->
                                                        <div class="col-sm-1">
                                                            <label for="countryLabel" class="col-form-label">Country</label>
                                                        </div>
                                                        <div class="col-sm-3 mb-3">
                                                            <input id="contryLabel" class="form-control" placeholder="Country">
                                                        </div>
                                
                                                        
                                                    </div>
                                
                                                    <!--Journal-->    
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label for="contentLabel" class="col-form-label">Journal</label>
                                                        </div>
                                                        <div class="col-sm-10 mb-3">
                                                            <input id="journalLabel" class="form-control" placeholder="Journal">
                                                        </div>
                                                    </div>
                                                    
                                                    <!--Measure-->
                                                    <div class="row mb-3">
                                                        <div class="col-sm-2">
                                                            <label for="measureLabel" class="col-form-label">Measure</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select id="settingLabel" class="form-select">
                                                                <option selected>Choose...</option>
                                                                <option value="Wellbeing">Wellbeing</option>
                                                                <option value="Self Determination">Self Determination</option>
                                                                <option value="Reseliance">Reseliance</option>
                                                            </select>    
                                                        </div>
                                                    </div>
                                                    <!--Program Content-->
                                                    <div class="row mb-3">
                                                        <div class="col-sm-2">
                                                            <label for="programContentLabel" class="col-form-label">Program Content</label>
                                                        </div>
                                                        <div class="col-sm-10" >
                                                            <textarea class="form-control" id="programContentLabel" rows="2"></textarea>   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Save as
                            Draft</button>
                        <button type="button" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal-->

        <!--Table List-->
        <div class="container-fluid mt-3 p-2">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Health Domain</th>
                        <th scope="col">Requestor</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    <tr>
                        <th scope="row">1</th>
                        <td class="col-sm-4">The Resilience Questionnaire</td>
                        <td>Emotional</td>
                        <td>Person 1</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Open</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Resilience Scale</td>
                        <td>Emotional</td>
                        <td>Person 1</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Open</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Response to Stress Questionnaire - Outdoor Adventure Version</td>
                        <td>Cognitve</td>
                        <td>Person 1</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Open</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!--Table List-->
    </main>
@endsection