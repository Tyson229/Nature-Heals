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
    <a class="nav-link bg-primary text-white " href="/login/user">
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
    <main>
        <h1 class="display-5">User Management</h1>
        <div class="row">
            <!--Add new tool button-->
            <div class="col-sm-3">
                <button class=" btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createToolForm"><i class="fas fa-plus"></i> Add New Admin</button>
            </div>
            <div class="col-sm-4"></div>
            <!--Search Bar-->
            <div class="col-sm-5">
                <div class="input-group rounded">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                      aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                      <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        
        <!--Modal-->
        <!--Pop up form-->
        <div class="modal fade" id="createToolForm" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createToolFormLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark" >
                        <h1 class="text-white display-6">Add New Admin</h1>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container bg-white">
                            <form>      
                                <div class="row">    
                                    <!--Name-->
                                    <div class="col-sm-2">
                                        <label for="nameLabel" class="col-form-label">Name</label>
                                    </div>
                                    <div class="col-sm-10 mb-3">
                                        <input id="nameLabel" class="form-control" placeholder="Name">
                                    </div>
                                    
                                    <!--Username-->
                                    <div class="col-sm-2">
                                        <label for="ussernameLabel" class="col-form-label">Username</label>
                                    </div>
                                    <div class="col-sm-10 mb-3">
                                        <input id="usernameLabel" class="form-control" placeholder="Username">
                                    </div>

                                    <!--Password-->
                                    <div class="col-sm-2">
                                        <label for="passwordLabel" class="col-form-label">Password</label>
                                    </div>
                                    <div class="col-sm-10 mb-3">
                                        <input id="passwordLabel" class="form-control" placeholder="password">
                                    </div>
                                    
                                    <!--Roles-->
                                    <div class="col-sm-2">
                                        <label for="rolesLabel" class="col-form-label">Roles</label>
                                    </div>
                                    <div class="col-sm-4">        
                                        <select id="rolesLabel" class="form-select">
                                            <option selected value="Admin">Admin</option>
                                            <option value="Owner">Owner</option>
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
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>

                <tbody class="bg-white">
                <tr>
                    <th scope="row">1</th>
                    <td>Person 1</td>
                    <td>person1@admin.com</td>
                    <td>admin1</td>
                    <td>Admin</td>
                    <td>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createToolForm">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Owner 1</td>
                    <td>Owner1@owner.com</td>
                    <td>owner</td>
                    <td>Owner</td>
                    <td>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createToolForm">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Person 2</td>
                    <td>person2@admin.com</td>
                    <td>admin2</td>
                    <td>Admin</td>
                    <td>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createToolForm">Edit</button>
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

    </main>
@endsection