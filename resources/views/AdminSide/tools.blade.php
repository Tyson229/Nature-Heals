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
            <div class="col-sm-3">
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
                                
                                    <div class="main">
                                        <h2>Tool Details</h2> 
                                        <!--Tool Name-->
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <label for="createToolName" class="col-form-label">Tool Name</label>
                                            </div>
                                            <div class="col">
                                                <input id="createToolName" name="createToolName" class="form-control" placeholder="Enter your tool name here..." required>
                                            </div>
                                        </div>
                                        
                                        <!--Description-->  
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <label for="createDescription" class="col-form-label">Description</label>
                                            </div>
                                            <div class="col">
                                                <textarea id="createDescription" name="createDescription" class="form-control" placeholder="Enter your description here..." required></textarea>
                                            </div>
                                        </div>   
                                        <!--Health Domain & Age Group-->
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <label for="createHealthDomainLabel" class="col-form-label">Health Domain</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="createHealthDomainLabel" name="createHealthDomainLabel"  class="form-select" required>
                                                    <option>Choose...</option>
                                                    <option value="1">Emotional</option>
                                                    <option value="2">Social</option>
                                                    <option value="3">Physical</option>
                                                    <option value="4">Cognitive</option>
                                                    <option value="5">Spiritual</option>
                                                    <option value="6">Employment</option>
                                                </select>    
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-2">
                                                <label for="createAgeGroupLabel" class="col-form-label">Age Group</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="createAgeGroupLabel" name="createAgeGroupLabel" class="form-select" required>
                                                    <option>Choose...</option>
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
                                                <label for="createNotesLabel" class="col-form-label">Notes</label>
                                            </div>     
                                            <div class="col-sm-10">
                                                <textarea id="createNotesLabel" name="createNotesLabel" class="form-control" rows="3" placeholder="Write your note here..."></textarea>
                                            </div>
                                        </div>
                    
                                        <!--Link-->
                                        <div class="row mb-3">     
                                            <div class="col-sm-2">
                                                <label for="createLinkLabel" class="col-form-label">Link</label>
                                            </div>
                                            <div class="col-sm-10 links">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <input id="createLinkLabel" name="createLinkLabel" class="form-control" placeholder="Upload your link here...">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button name="addLink" id="addLink" class="btn btn-outline-primary" title="Add more links"><i class="fas fa-plus"></i></button>
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
                                                                <label for="createGenderLabel" class="col-form-label">Gender</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input id="createGenderLabel" name="createGenderLabel" class="form-control" placeholder="Gender">
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
                                                                <label for="createModality" class="col-form-label">Recreation Modality</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createModality" name="createModality" class="form-select">
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
                                                                <label for="createSpecificNB" class="col-form-label">Specific for Nature Base</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createspecificNB" name="createspecificNB" class="form-select">
                                                                    <option >Choose...</option>
                                                                    <option value="1">Yes</option>
                                                                    <option value="0">No</option>
                                                                </select>   
                                                            </div>
                                                            <div class="col-sm-1"></div>
                                                            <!--Settings-->
                                                            <div class="col-sm-2">
                                                                <label for="createSettingLabel" class="col-form-label"> Nature Settings</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createSettingLabel" name="createSettingLabel" class="form-select">
                                                                    <option >Choose...</option>
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
                                                                    <option >Choose...</option>
                                                                    <option value="1">Validate</option>
                                                                    <option value="0">Not Validated</option>
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
                                                                <label for="createAuthorLabel" class="col-form-label">Author</label>
                                                            </div>
                                                            <div class="col-sm-10 mb-3">
                                                                <input id="createAuthorLabel" name="createAuthorLabel" class="form-control" placeholder="Author">
                                                            </div>
                                                            <!--Title-->
                                                            <div class="col-sm-2">
                                                                <label for="createTitleLabel" class="col-form-label">Article Title</label>
                                                            </div>
                                                            <div class="col-sm-10 mb-3">
                                                                <input id="createTitleLabel" name="createTitleLabel" class="form-control" placeholder="Title">
                                                            </div>
                                                            <!--Date-->
                                                            <div class="col-sm-2">
                                                                <label for="createDateLabel" class="col-form-label">Date</label>
                                                            </div>
                                                            <div class="col-sm-3 mb-3">
                                                                <input id="createDateLabel" name="createDateLabel" class="form-control" placeholder="Date">
                                                            </div>
                                                            <div class="col-sm-1"></div>
                                                            <!--Country-->
                                                            <div class="col-sm-1">
                                                                <label for="createCountryLabel" class="col-form-label">Country</label>
                                                            </div>
                                                            <div class="col-sm-3 mb-3">
                                                                <input id="createCountryLabel" name="createCountryLabel" class="form-control" placeholder="Country">
                                                            </div>
                                                        </div>
                                    
                                                        <!--Journal-->    
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <label for="createJournalLabel" class="col-form-label">Journal</label>
                                                            </div>
                                                            <div class="col-sm-10 mb-3">
                                                                <input id="createJournalLabel" name="createJournalLabel" class="form-control" placeholder="Journal">
                                                            </div>
                                                        </div>
                                                        
                                                        <!--Measure-->
                                                        <div class="row mb-3">
                                                            <div class="col-sm-2">
                                                                <label for="createMeasureLabel" class="col-form-label">Measure</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select id="createMeasureLabel" name="createMeasureLabel" class="form-select">
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
                                                                <label for="createProgramContentLabel" class="col-form-label">Program Content</label>
                                                            </div>
                                                            <div class="col-sm-10" >
                                                                <textarea class="form-control" id="createProgramContentLabel" name="createProgramContentLabel" rows="2"></textarea>   
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Save as
                                Draft</button>
                            <button type="button" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Create Modal-->

        <!--Table List-->
        <div class="container-fluid mt-2 p-0">
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
                    <tr>
                        <th scope="row">1</th>
                        <td class="col-sm-4">The Resilience Questionnaire</td>
                        <td>Emotional</td>
                    
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Resilience Scale</td>
                        <td>Emotional</td>
                        
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Response to Stress Questionnaire - Outdoor Adventure Version</td>
                        <td>Cognitve</td>
                        
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Edit</button>
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

@section('script')
    <script type="text/javascript">
        $(function() {
            $('a.pl').click(function(e) {
                e.preventDefault();
                $('#phone').append('<input type="text" value="Phone">');
            });
            $('a.mi').click(function (e) {
                e.preventDefault();
                if ($('#phone input').length > 1) {
                    $('#phone').children().last().remove();
                }
            });
        });
    </script>
    <!--<div class="col-sm-1">
        <button name="addLink" id="addLink" class="btn btn-outline-danger" title="Delete link"><i class="fas fa-minus"></i></button>
    </div>-->
@endsection