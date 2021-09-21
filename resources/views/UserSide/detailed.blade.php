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
    @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session('message'))
    <div class="bg-white container border rounded-3 mt-1 mb-3">
    @else
    <div class="bg-white container border rounded-3 mt-5 mb-3">
    @endif    
        <div class="p-5 rounded-3">
            <h1 class="display-5">{{$tool->tool_name}}</h1>
            @if($tool->creadit)
                    <p class="text-secondary">{{ $tool->creadit }}</p>
            @endif
        </div>
        
        <div class="description p-3 m-1">
            <h4 class="fw-bold"> Description </h4>
                <p>{{$tool->tool_description}}</p>
                
        </div>
        
        <div class="p-2"> 
            <h4 class="fw-bold mt-3"> Details </h4>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li class=mb-1><b>Health Domain:</b> {{$tool->health_domain ?? 'N/A'}}</li>
                                <li class=mb-1><b>Health Condition:</b> {{$tool->health_condition ?? 'N/A'}}</li>
                                <li class=mb-1><b>Recreation Modality:</b> {{$tool->modality ?? 'N/A'}}</li> 
                                <li class=mb-1><b>Nature Setting:</b> {{$tool->settings ?? 'N/A'}}</li>    
                                <li class=mb-1><b>Age Group:</b> {{$tool->age_group ?? 'N/A'}}</li>
                                        
                            </ul>
                        </div>
                        
                        <div class="col">
                            <ul>
                                <li class=mb-1><b>Gender:</b> {{$tool->gender ?? 'N/A'}}</li>
                                <li class=mb-1><b>Validity:</b> {{$tool->validity ?? 'N/A'}}</li>
                                <li class=mb-1><b>Reliability:</b> {{$tool->reliability ?? 'N/A'}}</li>
                                <li class=mb-1><b>Specific for Nature Base:</b> {{$tool->specific_NB ?? 'N/A'}}</li>
                                <li><b>Outcome:</b> {{$tool->outcome ?? 'N/A'}}</li>
                            </ul>
                        </div>
                    </div>
                     
                </div>
                @if(isset($tool->linkLists) && count($tool->linkLists) > 0)
                <hr>
                <h4 class="fw-bold"> Studies Have Used This Tool </h4>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <ol>
                                    @foreach ($tool->linkLists as $link)
                                        <li class="mb-1"><a href="{{$link->link}}" target="_blank">{{$link->study_name}}</a> </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                @endif         
        </div>
    </div>

    <div class="container mb-5 rounded-3 bg-white">
        <div class="row">
            <div class="feedback_title col-sm-3 ">
                <h1 class="display-6">Is this tool useful?</h1> 
            </div>

            <div class="col-sm-9 feedback p-3">
                <form id="feedback-form" method="POST" action="{{route('tools.store-feedback', ['id' => $tool->id])}}">
                    @csrf
                    <div class="container p-0">
                        <div class="row">
                            <div class="col form-group">
                                <b><label for="fname"> First name </label></b>
                                <input name="fname" type ="text" id="fname" name="fname" class="form-control" required>
                            </div>
                            
                            <div class="col form-group">
                                <b><label for="lname"> Last name </label></b>
                                <input name="lname" type ="text" id="lname" name="lname" class="form-control" required>
                            </div>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <b><label for="email"> Email </label></b>
                        <input name="email" type="email" id="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <b><label for="Comment">Comment: </label><br></b>
                        <textarea name="comment" rows="3" class="form-control" required></textarea>
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