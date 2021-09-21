@extends('layouts.userLayout')

@section('style')
<style>
    html{
        font-size:1.2rem;
    }
    
    body {
        margin-top: 0px;
        width: 100%;
        background: #eee;
    }

    .btn {
        margin-bottom: 1px;

    }
    
    .logo{
            width: 20vh;
    }

    .footer-title ,.footer-copyright{
            color:#96c0b7;
    }

    .grid {
        position: static;
        width: 100%;
        background: #fff;
        color: #666666;
        border-radius: 2px;
        margin-bottom: 25px;
    }


    .grid-body {
        padding: 20px 20px 20px 20px;
        font-size: 0.8em;
        line-height: 2.0em;
        background: white;
    }

    .search table tr:hover {
        cursor: pointer;
    }


    ul.nav a:hover {
        color: white !important;
        background-color: #96c0b7 !important;
        border-radius: 3px;
    }

    .table-responsive {

        background: rgb(245, 245, 245);

    }

    .Selection-heading {

        background: rgb(150, 192, 183);
        padding: 20px;


    }
    a.link1{
        color:black;
        text-decoration: none!important;
    }
    a{
        text-decoration: none!important;
    }
    a:hover{
        text-decoration: none!important;
    }
</style>
@endsection

@section('nav-bar')
<li class="nav-item"><a href="/" class="nav-link">Home</a></li>

<li class="nav-item"><a href="/tools" class="nav-link"style="color: white; background-color: #96c0b7; border-radius: 3px;">Tools</a></li>

<li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>

<li class="nav-item"><a href="/request" class="nav-link">Request</a></li>
<li class="nav-item"><a href="/login" class="nav-link ms-4 text-light">For Admin</a></li>
@endsection

@section('content')
    <div class="container mt-5 mb-5 "> 
        <div class="grid search">
            <div class="grid-body border rounded-3">
                <div class="row">

                    <!-- Category col  -->
                    <div class="col-md-3 mt-4 mb-4">

                        <h4 class="grid-title"><i class="category"></i> &nbsp;Select Category</h4>
                        
                        <!-- collapsed for Category and checkbox -->
                        <div class="accordion" id="accordionCategoryStayOpenSelection">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="CategoryStayOpen-headingOne">
                                <button  class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#CategoryStayOpen-collapseOne" aria-expanded="true" aria-controls="CategoryStayOpen-collapseOne">
                                    Domain Assessed 
                                </button>
                              </h2>
                              <div id="CategoryStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="CategoryStayOpen-headingOne">
                                <div class="accordion-body">

                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Emotional</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Social</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Physical</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Cognitive</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Spiritual</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Employment </label>
                                    </div>
                                </div>
                              </div>
                            </div>

                            <!-- collapsed  #2 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="CategoryStayOpen-headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#CategoryStayOpen-collapseTwo" aria-expanded="true" aria-controls="CategoryStayOpen-collapseTwo">
                                    Health Condition  
                                </button>
                              </h2>
                              <div id="CategoryStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="CategoryStayOpen-headingTwo">
                                <div class="accordion-body">
                                    
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> PTSD</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Mental Health Disorders</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Physical/Development disabilities</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Substance misuse</label>
                                    </div>
                                </div>
                              </div>
                            </div>
                          
                            <!-- collapsed  #3 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="CategoryStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CategoryStayOpen-collapseThree" aria-expanded="false" aria-controls="CategoryStayOpen-collapseThree">
                                    Recreation Modality  
                                </button>
                              </h2>
                              <div id="CategoryStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="CategoryStayOpen-headingThree">
                                <div class="accordion-body">
                                 
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Horticulture</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Equine Therapy</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Bush Therapy</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Therapeutic Recreation</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Outdoor Adventure</label>
                                    </div>
                                </div>
                              </div>
                            </div>      

                            <!-- collapsed  #4 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="CategoryStayOpen-headingFour">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CategoryStayOpen-collapseFour" aria-expanded="false" aria-controls="CategoryStayOpen-collapseFour">
                                    Nature Settings
                                  </button>
                                </h2>
                                <div id="CategoryStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="CategoryStayOpen-headingFour">
                                  <div class="accordion-body">
                                   
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Bluespace</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Greenspace</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Wild Nature</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Camp/Residential</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> Urban Natuer</label>
                                    </div>
                                  </div>
                                </div>
                            </div>                                   
                             <!-- collapsed  #5 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="CategoryStayOpen-headingFive">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CategoryStayOpen-collapseFive" aria-expanded="false" aria-controls="CategoryStayOpen-collapseFive">
                                        Age Group 
                                  </button>
                                </h2>
                                <div id="CategoryStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="CategoryStayOpen-headingFive">
                                  <div class="accordion-body">
                                   
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> 0-10 years</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> 11-19 years</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> 20-29 years</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> 30-39 years</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> 40-49 years</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck"> +50 years</label>
                                    </div>
  
                                  </div>
                                </div>
                            </div>                            
                        </div>                                
                    </div>
                    <!-- Search assessment tool col  -->
                    <div class="col-md-9">
                        <h1 class="display-6"> Available assessment tools</h1>
                        <hr>

                        <div class="input-group">
                            <input class="form-control me-0" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>

                        

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>                                    
                                    @forelse ($tools as $tool)
                                        <tr class="tool-description" data-href="{{route('tools.detailed', ['id' => $tool->id])}}">
                                            <td class="number text-center" width="10%"><strong>#{{$loop->iteration}}</strong></td>
                                            <td class="ToolDetailed" width="65%">
                                                <strong>{{$tool->tool_name}}</strong>
                                                <br>                                                    
                                                @if(strlen($tool->tool_description) > 160 )
                                                    {{substr($tool->tool_description, 0, 160)}}...
                                                @else
                                                    {{$tool->tool_description}}
                                                @endif                                                    
                                            </td>
                                            <td class="domain text-right" width="25%">
                                                <strong>Health Domain: </strong> {{$tool->health_domain}}
                                                <br>
                                                <strong>Age Group: </strong> {{$tool->age_group}}
                                            </td> 
                                        </tr>
                                    @empty
                                        <tr><td colspan="3">No Records Found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{$tools->links()}}
                        </div>
                        <br>
                    

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
<script>
$(function(){
    $('body').on('click', '.tool-description', function(){
        window.location = $(this).attr('data-href');
    });
});
</script>
@endsection


