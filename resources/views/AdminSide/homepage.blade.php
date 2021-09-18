@extends('layouts.adminLayout')

@section('style')
    <style>
        .btn-squared-default{
            width: 10rem !important;
            height: 10rem !important;
        }
        html{
            font-size: 1.2rem;
        }
    </style>
@endsection

@section('nav-bar')
   
@if(auth()->user()->role->role_name == 'Owner')
    
    <a class="nav-link bg-primary text-white" href="/login/home">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Home
    </a>
    <a class="nav-link " href="/login/user">
        <div class="sb-nav-link-icon"><i class="fa fa-user-circle"></i></div>
        User Management
    </a> 
    <a class="nav-link " href="/login/tools">
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
@else

   <a class="nav-link bg-primary text-white" href="/login/home">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Home
   </a>

   <a class="nav-link " href="/login/tools">
    <div class="sb-nav-link-icon"><i class="fa fa-suitcase"></i></div>
    Assessment Tools
   </a> 

   <a class="nav-link" href="/login/todolist">
    <div class="sb-nav-link-icon"><i class="fa fa-server"></i></div>
    To-do List 
   </a> 

   <a class="nav-link" href="/login/draft">
    <div class="sb-nav-link-icon"> <i class="fab fa-firstdraft"></i> </div>
    Draft
   </a>

    @endif

@endsection

@section('content')

    <h1 class="display-5"> Hello {{ auth()->user()->fname }}</h1>  
    @if(auth()->user()->role->role_name == 'Owner')

    <div class="d-flex justify-content-center ">
        <div class="row mt-5 text-center">
              
            <a class="btn btn-primary btn-squared-default btn-lg m-2 " href="/login/user" role="button">
                <i class="fa fa-user-circle fa-3x mb-3"></i><br> User Management</a>

            <a class="btn btn-success btn-squared-default btn-lg m-2" href="/login/tools" role="button"> 
                <i class="fa fa-suitcase fa-3x mb-3"></i><br> Assessment Tools</a>

            <a class="btn btn-warning btn-squared-default btn-lg m-2" href="/login/request" role="button"> 
                <i class="fa fa-paper-plane fa-3x mb-3"></i><br>Tool Request </a>

            <a class="btn btn-danger btn-squared-default btn-lg m-2" href="/login/todolist" role="button">
                <i class="fa fa-server fa-3x mb-3"></i><br>To-do List</a>
                
            <a class="btn btn-dark btn-squared-default btn-lg m-2 " href="/login/feedback" role="button">
                <i class="fa fa-life-ring fa-3x mb-3"></i><br> Feeback</a>

            <a class="btn btn-secondary btn-squared-default btn-lg m-2" href="/login/draft" role="button">
                <i class="fab fa-firstdraft fa-3x mb-3"></i><br> Draft</a>
        </div>
    </div>
    @else
    <div class="d-flex justify-content-center ">
        <div class="row mt-5 text-center">
              
            

            <a class="btn btn-success btn-squared-default btn-lg m-2" href="/login/tools" role="button"> 
                <i class="fa fa-suitcase fa-3x mb-3"></i><br> Assessment Tools</a>

            

            <a class="btn btn-danger btn-squared-default btn-lg m-2" href="/login/todolist" role="button">
                <i class="fa fa-server fa-3x mb-3"></i><br>To-do List</a>
                
       

            <a class="btn btn-secondary btn-squared-default btn-lg m-2" href="/login/draft" role="button">
                <i class="fab fa-firstdraft fa-3x mb-3"></i><br> Draft</a>
        </div>
    </div>
    
    @endif
@endsection