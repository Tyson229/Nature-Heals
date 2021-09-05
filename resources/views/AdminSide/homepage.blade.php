@extends('layouts.adminLayout')

@section('style')
    <style>
        .btn-squared-default{
            width: 20vh !important;
            height: 28vh !important;
        }
        html{
            font-size: 1.2rem;
        }
    </style>
@endsection

@section('nav-bar')
   
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
        Pending Tool Request
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
    <h1 class="display-5"> Hello Admin</h1>
    <a class="btn btn-primary btn-squared-default btn-lg m-2" href="/login/user" role="button">
        <i class="fa fa-user-circle fa-6x mb-3"></i> User Management</a>

    <a class="btn btn-success btn-squared-default btn-lg m-2" href="/login/tools" role="button"> 
        <i class="fa fa-suitcase fa-6x mb-3"></i> Assessment Tools</a>

    <a class="btn btn-warning btn-squared-default btn-lg m-2" href="/login/request" role="button"> 
        <i class="fa fa-paper-plane fa-6x mb-3"></i>Pending Tool Request </a>

    <a class="btn btn-danger btn-squared-default btn-lg m-2" href="/login/todolist" role="button">
        <i class="fa fa-server fa-6x mb-3"></i><br>To-do List</a>

    <a class="btn btn-dark btn-squared-default btn-lg m-2 " href="/login/feedback" role="button"><i class="fa fa-life-ring fa-6x mb-3"></i><br> Feeback</a>
    <a class="btn btn-secondary btn-squared-default btn-lg m-2" href="/login/draft" role="button"><p><i class="fab fa-firstdraft fa-6x mb-1"></i></p> Draft</a>
@endsection