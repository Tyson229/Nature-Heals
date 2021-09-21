@extends('layouts.userLayout')

@section('style')
    <style>
        html {
            font-size: 1.2rem;
        }

        body {
            margin-top: 0px;
            width: 100%;
            background: #eee;
        }

        .btn {
            margin-bottom: 1px;
        }

        .logo {
            width: 20vh;
        }

        .footer-title,
        .footer-copyright {
            color: #96c0b7;
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

        a.link1 {
            color: black;
            text-decoration: none !important;
        }

        a {
            text-decoration: none !important;
        }

        a:hover {
            text-decoration: none !important;
        }

        .title{
            font-size: 1.2rem;
        }

    </style>
@endsection

@section('nav-bar')
    <li class="nav-item"><a href="/" class="nav-link">Home</a></li>

    <li class="nav-item"><a href="/tools" class="nav-link"
            style="color: white; background-color: #96c0b7; border-radius: 3px;">Tools</a></li>

    <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>

<li class="nav-item"><a href="/request" class="nav-link">Request</a></li>
<li class="nav-item"><a href="/login" class="nav-link ms-4 text-light">For Admin</a></li>
@endsection

@section('content')
    <div class="container mt-5 mb-5 ">
        <div class="grid search">
            <div class="grid-body border rounded-3">
                <form method="POST" action="{{ route('tools.search') }}">
                    @csrf
                    <div class="row">
                        <!-- Category col  -->
                        <div class="col-md-3 mt-4 mb-4">

                            <h4 class="grid-title"><i class="category"></i> &nbsp;Select Category</h4>
                            <!-- collapsed for Category and checkbox -->
                            <div class="accordion" id="accordionCategoryStayOpenSelection">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="CategoryStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#CategoryStayOpen-collapseOne" aria-expanded="true"
                                            aria-controls="CategoryStayOpen-collapseOne">
                                            Domain Assessed
                                        </button>
                                    </h2>
                                    <div id="CategoryStayOpen-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="CategoryStayOpen-headingOne">
                                        <div class="accordion-body">

                                            <div class="checkbox">
                                                <label><input type="checkbox" name="domains[]" class="icheck"
                                                        value="Emotional" @if (Session::has('domains') && in_array('Emotional', session('domains'))) checked @endif> Emotional</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="domains[]" class="icheck"
                                                        value="Social" @if (Session::has('domains') && in_array('Social', session('domains'))) checked @endif> Social</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="domains[]" class="icheck"
                                                        value="Physical" @if (Session::has('domains') && in_array('Physical', session('domains'))) checked @endif> Physical</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="domains[]" class="icheck"
                                                        value="Cognitive" @if (Session::has('domains') && in_array('Cognitive', session('domains'))) checked @endif> Cognitive</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="domains[]" class="icheck"
                                                        value="Spiritual" @if (Session::has('domains') && in_array('Spiritual', session('domains'))) checked @endif> Spiritual</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="domains[]" class="icheck"
                                                        value="Employment" @if (Session::has('domains') && in_array('Employment', session('domains'))) checked @endif> Employment </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- collapsed  #2 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="CategoryStayOpen-headingTwo">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#CategoryStayOpen-collapseTwo" aria-expanded="true"
                                            aria-controls="CategoryStayOpen-collapseTwo">
                                            Health Condition
                                        </button>
                                    </h2>
                                    <div id="CategoryStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="CategoryStayOpen-headingTwo">
                                        <div class="accordion-body">

                                            <div class="checkbox">
                                                <label><input type="checkbox" name="conditions[]" class="icheck"
                                                        value="PTSD" @if (Session::has('conditions') && in_array('PTSD', session('conditions'))) checked @endif> PTSD</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="conditions[]" class="icheck"
                                                        value="Mental Health Disorders" @if (Session::has('conditions') && in_array('Mental Health Disorders', session('conditions'))) checked @endif> Mental
                                                    Health Disorders</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="conditions[]" class="icheck"
                                                        value="Physical/Development disabilities" @if (Session::has('conditions') && in_array('Physical/Development disabilities', session('conditions'))) checked @endif>
                                                    Physical/Development disabilities</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="conditions[]" class="icheck"
                                                        value="Substance misuse" @if (Session::has('conditions') && in_array('Substance misuse', session('conditions'))) checked @endif> Substance
                                                    misuse</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                        <!-- collapsed  #3 -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="CategoryStayOpen-headingThree">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#CategoryStayOpen-collapseThree" aria-expanded="true"
                                                    aria-controls="CategoryStayOpen-collapseThree">
                                                    Recreation Modality
                                                </button>
                                            </h2>
                                            <div id="CategoryStayOpen-collapseThree" class="accordion-collapse collapse show"
                                                aria-labelledby="CategoryStayOpen-headingThree">
                                                <div class="accordion-body">

                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="modalities[]"
                                                                class="icheck" value="Horticulture"
                                                                @if (Session::has('modalities') && in_array('Horticulture', session('modalities'))) checked @endif> Horticulture</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="modalities[]"
                                                                class="icheck" value="Equin Therapy"
                                                                @if (Session::has('modalities') && in_array('Equin Therapy', session('modalities'))) checked @endif> Equine
                                                            Therapy</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="modalities[]"
                                                                class="icheck" value="Bush Therapy"
                                                                @if (Session::has('modalities') && in_array('Bush Therapy', session('modalities'))) checked @endif> Bush Therapy</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="modalities[]"
                                                                class="icheck" value="Therapeutic Recreation"
                                                                @if (Session::has('modalities') && in_array('Therapeutic Recreation', session('modalities'))) checked @endif>
                                                            Therapeutic Recreation</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="modalities[]"
                                                                class="icheck" value="Outdoor Adventure"
                                                                @if (Session::has('modalities') && in_array('Outdoor Adventure', session('modalities'))) checked @endif> Outdoor
                                                            Adventure</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- collapsed  #4 -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="CategoryStayOpen-headingFour">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#CategoryStayOpen-collapseFour" aria-expanded="true"
                                                    aria-controls="CategoryStayOpen-collapseFour">
                                                    Nature Settings
                                                </button>
                                            </h2>
                                            <div id="CategoryStayOpen-collapseFour" class="accordion-collapse collapse show"
                                                aria-labelledby="CategoryStayOpen-headingFour">
                                                <div class="accordion-body">

                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="settings[]"
                                                                class="icheck" value="Bluespace"
                                                                @if (Session::has('settings') && in_array('Bluespace', session('settings'))) checked @endif> Bluespace</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="settings[]"
                                                                class="icheck" value="Greenspace"
                                                                @if (Session::has('settings') && in_array('Greenspace', session('settings'))) checked @endif> Greenspace</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="settings[]"
                                                                class="icheck" value="Wild Nature"
                                                                @if (Session::has('settings') && in_array('Wild Nature', session('settings'))) checked @endif> Wild Nature</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="settings[]"
                                                                class="icheck" value="Camp/Residential"
                                                                @if (Session::has('settings') && in_array('Camp/Residential', session('settings'))) checked @endif>
                                                            Camp/Residential</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="settings[]"
                                                                class="icheck" value="Urban Nature"
                                                                @if (Session::has('settings') && in_array('Urban Nature', session('settings'))) checked @endif> Urban Natuer</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- collapsed  #5 -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="CategoryStayOpen-headingFive">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#CategoryStayOpen-collapseFive" aria-expanded="true"
                                                    aria-controls="CategoryStayOpen-collapseFive">
                                                    Age Group
                                                </button>
                                            </h2>
                                            <div id="CategoryStayOpen-collapseFive" class="accordion-collapse collapse show"
                                                aria-labelledby="CategoryStayOpen-headingFive">
                                                <div class="accordion-body">

                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="ageGroups[]"
                                                                class="icheck" value="0-11"
                                                                @if (Session::has('ageGroups') && in_array('0-11', session('ageGroups'))) checked @endif> 0-11 years</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="ageGroups[]"
                                                                class="icheck" value="12-17"
                                                                @if (Session::has('ageGroups') && in_array('12-17', session('ageGroups'))) checked @endif> 12-17 years</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="ageGroups[]"
                                                                class="icheck" value="18-25"
                                                                @if (Session::has('ageGroups') && in_array('18-25', session('ageGroups'))) checked @endif> 18-25 years</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="ageGroups[]"
                                                                class="icheck" value="55 and over"
                                                                @if (Session::has('ageGroups') && in_array('55 and over', session('ageGroups'))) checked @endif> +55</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="ageGroups[]"
                                                                class="icheck" value="All"
                                                                @if (Session::has('ageGroups') && in_array('All', session('ageGroups'))) checked @endif> All</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                </form>
            </div>
            <!-- Search assessment tool col  -->
            <div class="col-md-9">
                <h1 class="display-6"> Find Assessment Tools</h1>
                <hr>

                <div class="input-group">
                    <div class="input-group mb3">
                        <input class="form-control me-0" name="searched_keyword" type="search" placeholder="Search"
                            aria-label="Search" value="@if (session('searched_keyword') != null){{ Session::get('searched_keyword') }}@endif">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            @forelse ($tools as $tool)
                                <tr class="tool-description"
                                    data-href="{{ route('tools.detailed', ['id' => $tool->id]) }}">
                                    <td class="number text-center" width="3%"><strong>{{ $loop->iteration + $tools->firstItem() - 1 }}</strong>
                                    </td>
                                    <td class="ToolDetailed" width="67%">
                                        <strong class="title">{{ $tool->tool_name }}</strong>
                                        <br>
                                        @if (strlen($tool->tool_description) > 100)
                                            {{ substr($tool->tool_description, 0, 100) }}...
                                        @else
                                            {{ $tool->tool_description }}
                                        @endif
                                    </td>
                                    <td class="domain text-right" width="30%">
                                        <strong>Domain Assessed </strong> {{ $tool->health_domain }}
                                        <br>
                                        <strong>Nature Setting </strong> {{ $tool->settings }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Records Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <div class="d-flex"><div class="mx-auto">
                    {{$tools->links()}}
                </div>
            </div>
            
            
            </div>
          
        </div>
        
        </form>
       
    </div>
    
    </div>
   
    </div>
   

@endsection

@section('script')
    <script>
        $(function() {
            $('body').on('click', '.tool-description', function() {
                window.location = $(this).attr('data-href');
            });
        });
    </script>
@endsection
