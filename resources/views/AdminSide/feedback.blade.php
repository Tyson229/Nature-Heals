@extends('layouts.adminLayout')

@section('style')
<style>
    html{ font-size: 1.2rem;}
</style>
    
@endsection

@section('nav-bar')
@if(auth()->user()->role->role_name == 'Owner')

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
        Tool Request
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
    @else
    <a class="nav-link" href="/login/home">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Home
    </a>

    <a class="nav-link " href="/login/tools">
        <div class="sb-nav-link-icon"><i class="fa fa-suitcase"></i></div>
        Assessment Tools
    </a> 
 
    <a class="nav-link " href="/login/todolist">
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
    <main>
        <h1 class="display-5">Tool Feedback</h1>
       
        <div class="row"><!--make some space between table and title-->


        </div>

        <div class="modal fade" id="createToolForm" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createToolFormLabel" aria-hidden="true">
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
                                        <label for="usernameLabel" class="col-form-label">Name: John Doe</label>
                                    </div>
                                   
                                    
                                    <!--email-->
                                    <div class="col-sm-12">
                                        <label for="emailLabel" class="col-form-label">Email: person1@gmail.com</label>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="toolnameLabel" class="col-form-label">Tool name: The Resilience Questionnaire</label>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="domainnameLabel" class="col-form-label">Health Domain: Emotional</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="contentLabel" class="col-form-label">Feedback: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est, aperiam, necessitatibus placeat dignissimos numquam deserunt, voluptatum laboriosam similique nobis dolorum ea! Laborum, molestias? Id ducimus exercitationem aut debitis sint quo?</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="dateLabel" class="col-form-label">Date: 2/7/2021</label>
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



        <!--Table List-->
        <div class="container-fluid mt-2 p-0">
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
                    <tr data-bs-toggle="collapse" data-bs-target="#hidden">
                         
                        <td>1</td>
                        <td class="col-sm-2">John Doe</td>
                        <td>person1@gmail.com
                        <td class="col-sm-3">The Resilience Questionnaire</td>
                        <td>Emotional</td>
                        <td>2/7/2021</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Open</button>
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal1"
                            data-bs-target="#createToolForm"><i class="fas fa-trash"></i> Delete</button>   
                           
                        </td>
                    </tr>

                    <tr data-bs-toggle="collapse" data-bs-target="#hidden2">
                        
                         
                        <td>2</td>
                        <td class="col-sm-2">John Doe</td>
                        <td>person2@gmail.com
                        <td class="col-sm-3">The Resilience Questionnaire</td>
                        <td>Emotional</td>
                        <td>8/6/2021</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Open</button>
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal1"
                            data-bs-target="#createToolForm"><i class="fas fa-trash"></i> Delete</button>  
                        </td>
                    </tr>
                    
                    <tr data-bs-toggle="collapse" data-bs-target="#hidden3">
                        
                          
                        <td>3</td>
                        <td class="col-sm-2">John Doe</td>
                        <td>person3@gmail.com
                        <td class="col-sm-3">The Resilience Questionnaire</td>
                        <td>Emotional</td>
                        <td>3/6/2021</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Open</button>
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal1"
                            data-bs-target="#createToolForm"><i class="fas fa-trash"></i> Delete</button>  
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