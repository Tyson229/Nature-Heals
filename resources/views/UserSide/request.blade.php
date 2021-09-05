@extends('layouts.userLayout')

@section('style')
<style>
    html{
        font-size:1.2rem;
    }

    ul.nav a:hover { 
        color: white !important; 
        background-color: #96c0b7 !important;
        border-radius: 3px;
    }

    main {
        margin:auto;
        max-width: 970px;
    }
    
    .title{
        background-color: #96c0b7;
    }
     label{
         font-weight:600;
         color:#878e88;
     }
     .logo{
        width: 20vh;
    }
    .footer-title ,.footer-copyright{
        color:#96c0b7
    }
</style>
@endsection

@section('nav-bar')
    <li class="nav-item"><a href="/" class="nav-link" >Home</a></li>
    <li class="nav-item"><a href="/tools" class="nav-link">Tools</a></li>
    <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
    <li class="nav-item"><a href="/request" class="nav-link"style="color: white; background-color: #96c0b7; border-radius: 3px;">Request</a></li>
@endsection

@section('content')
<main class="flex-fill">
    <div class="container bg-white rounded-3 p-3 mt-5 mb-5 border">
        <form>
            <h1 class="display-5 text-center p-3 rounded-3 border title">Request a Tool</h1>
            <div class="row">
                <div class="main">
                    <h2>Your Details</h2>
                    <!-- Name-->
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <label for="visitorName" class="col-form-label">Full Name*</label>
                        </div>
                        <div class="col">
                            <input id="visitorName" class="form-control" placeholder="Enter your full name here..." required>
                        </div>
                    </div>
                    <!--Org Name-->
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="orgName" class="col-form-label">Organization Name</label>
                        </div>
                        <div class="col">
                            <input id="orgName" class="form-control" placeholder="Enter your organization name here..." required>
                        </div>
                    </div>
                    <!--Email-->
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <label for="visitorEmail" class="col-form-label">Email*</label>
                        </div>
                        <div class="col">
                            <input id="visitorEmail" class="form-control" placeholder="Enter your email here..." required>
                        </div>
                    </div>

                    <hr>
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
                    <div class="row mb-1">
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
                    

                <!--submit button-->
                    <div class="row mt-4 mb-3">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button class="btn btn-dark btn-lg float-end" type="button">Send Request</button>
                        </div>
                    </div>
            </div>

        </form>
    </div>


</main>
@endsection
