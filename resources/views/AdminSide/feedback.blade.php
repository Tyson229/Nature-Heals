@extends('layouts.adminLayout')

@section('style')
<style>
    html{ font-size: 1.2rem;}
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
    <a class="nav-link " href="/login/tools">
        <div class="sb-nav-link-icon"><i class="fa fa-suitcase"></i></div>
        Assessment Tools
    </a> 
    <a class="nav-link  " href="/login/request">
        <div class="sb-nav-link-icon"><i class="fa fa-paper-plane"></i></div>
        Pending Tool Request
    </a>
    <a class="nav-link " href="/login/todolist">
        <div class="sb-nav-link-icon"><i class="fa fa-server"></i></div>
        To-do List 
    </a> 
    <a class="nav-link bg-primary text-white" href="/login/feedback">
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
        <h1 class="display-5">Tool Feedback</h1>
       
        <div class="row"><!--make some space between table and title-->


        </div>
        <!--Table List-->
        <div class="container-fluid mt-2 p-0">
            @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tool Name</th>
                        <th scope="col">Health Domain</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($feedbacks as $feedback)
                        <tr data-bs-toggle="collapse" data-bs-target="#content-row-{{$feedback->id}}"> 
                            <td>{{$loop->iteration}}</td>
                            <td class="col-sm-2">{{$feedback->name}}</td>
                            <td>{{$feedback->email}}</td>
                            <td class="col-sm-3">{{$feedback->tool->tool_name}}</td>
                            <td>{{$feedback->tool->health_domain}}</td>
                            <td>{{$feedback->created_at->format('d-m-Y')}}</td>
                            <td>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#view-feedback-{{$feedback->id}}">Open</button>
                                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteFeedback-{{$feedback->id}}"><i class="fas fa-trash"></i> Delete</button>   
                            </td>

                            <!-- display information modal -->
                            <div class="modal fade" id="view-feedback-{{$feedback->id}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createToolFormLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark" >
                                            <h1 class="text-white display-6">Feedback Detail</h1>
                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container bg-white">
                                                <form>      
                                                    <div class="row">    
                                                        <!--Name-->
                                                        <div class="col-sm-12">
                                                            <label for="usernameLabel" class="col-form-label">Name: {{$feedback->name}}</label>
                                                        </div>
                                                       
                                                        
                                                        <!--email-->
                                                        <div class="col-sm-12">
                                                            <label for="emailLabel" class="col-form-label">Email: {{$feedback->email}}</label>
                                                        </div>
                    
                                                        <div class="col-sm-12">
                                                            <label for="toolnameLabel" class="col-form-label">Tool name: {{$feedback->tool->tool_name}}</label>
                                                        </div>
                    
                                                        <div class="col-sm-12">
                                                            <label for="domainnameLabel" class="col-form-label">Health Domain: {{$feedback->tool->health_domain}}</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="contentLabel" class="col-form-label">Feedback: {{$feedback->comment}}</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="dateLabel" class="col-form-label">Date: {{$feedback->created_at->format('d-m-Y')}}</label>
                                                        </div>
                                                    </div> 
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- display information modal-->

                            <!--Delete Modal-->
                            <div class="modal fade" id="deleteFeedback-{{$feedback->id}}" tabindex="-1" aria-labelledby="deleteUserFormLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger" >
                                            <h1 class="text-white display-6">You want to delete this feedback?</h1>
                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('feedback.delete', ['id' => $feedback->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="container bg-white">
                                                <div class="row">    
                                                    <!--Name-->
                                                    <div class="col-sm-12">
                                                        <label for="usernameLabel" class="col-form-label">Name: {{$feedback->name}}</label>
                                                    </div>
                                                   
                                                    
                                                    <!--email-->
                                                    <div class="col-sm-12">
                                                        <label for="emailLabel" class="col-form-label">Email: {{$feedback->email}}</label>
                                                    </div>
                
                                                    <div class="col-sm-12">
                                                        <label for="toolnameLabel" class="col-form-label">Tool name: {{$feedback->tool->tool_name}}</label>
                                                    </div>
                
                                                    <div class="col-sm-12">
                                                        <label for="domainnameLabel" class="col-form-label">Health Domain: {{$feedback->tool->health_domain}}</label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label for="contentLabel" class="col-form-label">Feedback: {{$feedback->comment}}</label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label for="dateLabel" class="col-form-label">Date: {{$feedback->created_at->format('m-d-Y')}}</label>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-secondary" value="Submit">Yes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Delete Modal-->
                        </tr>
                    @empty
                        <tr><td colspan="7">No Records Found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{$feedbacks->links()}}
        </div>
        <!--Table List-->
    </main>
@endsection