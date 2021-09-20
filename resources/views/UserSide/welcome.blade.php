@extends('layouts.userLayout')

@section('style')
<style>
    ul.nav a:hover { 
        color: white !important; 
        background-color: #96c0b7 !important;
        border-radius: 3px;
    }
    
    .logo{
        width: 20vh;
    }
    .footer-title ,.footer-copyright{
        color:#96c0b7
    }
    html{
        font-size: 1.2rem;
    }
    
    p{
        text-align: justify;
    }
</style>
@endsection

@section('nav-bar')
    <li class="nav-item"><a href="/" class="nav-link" style="color: white; background-color: #96c0b7; border-radius: 3px;">Home</a></li>
    <li class="nav-item"><a href="/tools" class="nav-link">Tools</a></li>
    <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
    <li class="nav-item"><a href="/request" class="nav-link">Request</a></li>
@endsection

@section('content')
    <main class="flex-fill bg-light" >
        <!-- Background image -->
        <div class="bg-image d-flex justify-content-center align-items-center" style="
                    background-image: url('/pictures/wallpaper.jpg');
                    height: 30vh;
        ">
            <h1 class="text-white display-1">Welcome to Nature Heals</h1>
        </div>
        <!-- Background image -->
        
        <!--Content-->
        <div class="container mt-5">
            <h1 class="display-5 mb-4"><b>About Us</b></h1>
            <p>
                Nature Heals is a repository of studies and assessment tools that are used to measure the impacts of nature-based therapies on participants’ wellbeing. It is a searchable online database that provides practitioners with categorized information that will help them select a tool to effectively assess the impact of their nature-based interventions on participants’ wellbeing or to find a study that have used a similar intervention to improve participants’ health. Users can choose whether they want a tool to measure physical, social, emotional or mental wellbeing, as well as tools that may be used with children, or studies focused on particular nature-based locations. 
            </p>
            
            <p> 
                Users can help us build this resource by sending us new publications or tools they are aware of that can be used by others to assess their programs and interventions.
            </p>
            
            <p>
                This site is a project developed through a community of interested nature enthusiasts and emerging professionals, involving university students, academics and professionals. The project was conceptualized by Dr Nicole Peel, Dr Arianne Reis and Professor Tonya Gray from Western Sydney University and has had the contribution of many students along the way. Learn more about us below. 
            </p><br>
            
            
            <h1 class="display-5 mt-3 mb-4"><b>Our Team</b></h1>
            <div class="row gap-3 mb-5">
                
                <div class="col">
                    <div class="card border rounded-3 shadow-sm" style="background-color: #96c0b7;">
                        <img src="/pictures/Logo.jpg" class="card-img-top" width="200" height="350">
                        <div class="card-body">
                            <h1 class="display-6 mb-3 text-center card-title">Dr. Nicole Peel</h1>
                            <p class="card-text">
                                Dr. Nicole Peel is a Lecturer in Recreational Therapy at Western Sydney University, and an expert in leisure, wellbeing and inclusion.<br> Dr. Peel is an avid cyclist, bushwalker and is most at home in any outdoor recreation environment where she passionately supports sustainable practice. 
                            </p>
                        </div>
                    </div> 
                </div>
                <div class="col">
                    <div class="card border rounded-3 shadow-sm" style="background-color: #7fcaba;">
                        <img src="/pictures/Logo.jpg" class="card-img-top" width="200" height="350">
                        <div class="card-body">
                            <h1 class="display-6 mb-3 text-center card-title">Dr. Arianne Reis</h1>
                            <p class="card-text mb-4">
                                Dr. Arianne Reis is a Senior Lecturer in Leisure and Recreation Studies at Western Sydney University, and an expert in leisure and wellbeing.<br> Dr. Reis is an avid bushwalker and (probably soon retiring!) rock climber and passionate about being outdoor.
                            </p>
                            
                        </div>
                    </div> 
                </div>
                <div class="col">
                    <div class="card border rounded-3 shadow-sm" style="background-color: #96c0b7;">
                        <img src="/pictures/wsu-shield.jpg" class="card-img-top" width="200" height="350">
                        <div class="card-body">
                            <h1 class="display-6 mb-3 text-center card-title">Dev Team</h1>
                            <p class="card-text" style="margin-bottom: 5.8rem;">
                                A group of dedicated university students, whom have helped Dr.Nicole and Dr.Arianne develop and operate Nature Heals.
                            </p>
                        </div>
                    </div> 
                </div>  
            </div>
        </div>
        <!--Content-->    
    </main>
@endsection
