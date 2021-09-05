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

    .description {
        background-color: #96c0b7;
    }
    .feedback_title{
        background-color: #96c0b7;
        border-style: solid;
        border-width: 2px;
        border-color: #96c0b7;
        border-radius: 3px 0 0 3px;
    }
    .feedback{
        border-style: solid;
        border-width: 5px;
        border-color: #96c0b7;
        border-radius: 0 3px 3px 0;
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
<li class="nav-item"><a href="/" class="nav-link">Home</a></li>    
<li class="nav-item"><a href="/tools" class="nav-link"style="color: white; background-color: #96c0b7; border-radius: 3px;">Tools</a></li>
<li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
<li class="nav-item"><a href="/request" class="nav-link">Request</a></li>
@endsection

@section('content')
<main class="flex-fill">
        
    <div class="bg-white container border rounded-3 mt-5 mb-3">
        <div class="p-5 rounded-3">
            <h1 class="display-5"> Resilience Scale</h1>
        </div>
        
        <div class="description p-3 m-1">
            <h4 class="fw-bold"> Description </h4>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris interdum faucibus tristique. Nunc vehicula suscipit lectus vitae egestas. Integer lacus metus, iaculis vel consectetur sed, viverra a lorem. Sed nisi risus, ultrices quis faucibus quis, imperdiet tempus nisi. Suspendisse commodo eleifend tempus. Quisque in volutpat lacus. Proin convallis porta est a rhoncus. Curabitur volutpat pulvinar sodales. Pellentesque non fringilla metus. Donec rhoncus nibh ullamcorper urna bibendum, ut cursus turpis condimentum. Nam at sem imperdiet, luctus libero non, bibendum leo.</p>
                
        </div>
        
        <div class="p-2"> 
            <h4 class="fw-bold mt-3"> Details </h4>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li class=mb-1><b>Health Domain:</b> Emotional</li>
                                <li class=mb-1><b>Health Condition:</b> Not Applicable</li>
                                <li class=mb-1><b>Recreation Modality:</b> Sailing</li> 
                                <li class=mb-1><b>Nature Setting:</b> Not Applicable</li>    
                                <li class=mb-1><b>Age Group:</b> Youth</li>
                                        
                            </ul>
                        </div>
                        
                        <div class="col">
                            <ul>
                                <li class=mb-1><b>Gender:</b> All</li>
                                <li class=mb-1><b>Validity:</b> Validated</li>
                                <li class=mb-1><b>Reliability:</b> Yes</li>
                                <li class=mb-1><b>Specific for Nature Base:</b> No</li>
                                <li><b>Outcome:</b> Emotional Resilience, Goal Setting, Healthy Risk-taking, Locus of Control, Self-Awareness, Self-Esteem, Self-Confidence, Communication Skills, Community Engagement, and Cooperative Teamwork</li>
                            </ul>
                        </div>
                    </div>
                     
                </div>
                <hr>
                <h4 class="fw-bold"> Studies Have Used This Tool </h4>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <ol>
                                    <li class="mb-1"><a href="#">Link one</a> </li>
                                    <li class="mb-1"><a href="#">Link one</a> </li>
                                    <li class="mb-1"><a href="#">Link one</a> </li>
                                    <li class="mb-1"><a href="#">Link one</a> </li>
                                    <li class="mb-1"><a href="#">Link one</a> </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                
        </div>
    </div>

    <div class="container mb-5 rounded-3 bg-white">
        <div class="row">
            <div class="feedback_title col-sm-3 ">
                <h1 class="display-6">Your Feedback</h1> 
            </div>

            <div class="col-sm-9 feedback p-3">
                <form>
                    <div class="container p-0">
                        <div class="row">
                            <div class="col form-group">
                                <b><label for="fname"> First name </label></b>
                                <input type ="text" id="fname" class="form-control">
                            </div>
                            
                            <div class="col form-group">
                                <b><label for="lname"> Last name </label></b>
                                <input type ="text" id="fname" class="form-control">
                            </div>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <b><label for="email"> Email </label></b>
                        <input type ="email" id="email" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <b><label for="Comment">Comment: </label><br></b>
                        <textarea rows="3" class="form-control" ></textarea>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark btn-lg mt-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</main>
@endsection