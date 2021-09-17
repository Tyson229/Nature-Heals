@extends('layouts.adminLayout')

@section('style')
<style>
    html{
        font-size: 1.2rem;
    }

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
        Tool Request
    </a>
    <a class="nav-link bg-primary text-white" href="/login/todolist">
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

    <main>
        <h1 class="display-5">To do List</h1>
        <div class="row">
            <!--Add new tool button-->
            <div class="col-sm-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" alt=""
                data-bs-target="#createTaskForm"><i class="fas fa-plus"></i> Add new task</button>
            </div>
        </div>

         <!--Modal-->
        <div class="modal fade" id="createTaskForm" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createTaskFormLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-lg">
                    <div class="modal-header bg-dark" >
                        <h1 class="text-white display-6">Add Task</h1>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container bg-white">
                            <form>      
                                <div class="row">    
                                    <!--Task-->
                                    <div class="col-sm-2">
                                        <label for="taskLabel" class="col-form-label">Task</label>
                                    </div>
                                    <div class="col-sm-10 mb-3">
                                        <input id="taskLabel" class="form-control" placeholder="Task">
                                    </div>

                                    <!--Priortity-->
                                    <div class="col-sm-2">
                                        <label for="priorityLabel" class="col-form-label">Priority</label>
                                    </div>
                                    <div class="col-sm-4">        
                                        <select id="priorityLabel" class="form-select">
                                            <option selected value="High">High</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Low">Low</option>
                                        </select>    
                                    </div>
                                
                                </div> 
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal-->

        <!--Table List-->
        <div class="container-fluid mt-2 p-0">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Check</th>
                        <th scope="col">Task</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Creator</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    <tr>
                        <th scope="row">
                            <button class="btn btn-outline-success"><i class="fas fa-check"></i></button>
                        </th>
                        <td class="col-sm-4">Task 1</td>
                        <td class="col-sm-1">Low</td>
                        <td class="col-sm-2">Person 1</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                            
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <button class="btn btn-outline-success"><i class="fas fa-check"></i></button>
                        </th>
                        <td class="col-sm-4">Task 1</td>
                        <td class="col-sm-1">Low</td>
                        <td class="col-sm-2">Person 1</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                            
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <button class="btn btn-outline-success"><i class="fas fa-check"></i></button>
                        </th>
                        <td class="col-sm-4">Task 1</td>
                        <td class="col-sm-1">Low</td>
                        <td class="col-sm-2">Person 1</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createToolForm">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                            
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