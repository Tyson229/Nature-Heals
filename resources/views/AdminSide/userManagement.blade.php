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
@endsection

@section('content')
    <main>
        <h1 class="display-5">User Management</h1>
        <div class="row">
            <!--Add new tool button-->
            <div class="col-sm-3">
                <button class=" btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createUserForm"><i class="fas fa-plus"></i> Add New Admin</button>
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
        
        <!--Create Modal-->
        <!--Pop up form-->
        <div class="modal fade" id="createUserForm" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserFormLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark" >
                        <h1 class="text-white display-6">Add New Admin</h1>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/login/user" method="POST">
                        @csrf
                    <div class="modal-body">
                        <div class="container bg-white">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                                @endif  
                                <div class="row">    
                                    <!--First Name-->
                                    <div class="col-sm-4">
                                        <label for="fnameLabel" class="col-form-label">First Name</label>
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <input id="fnameLabel" name="fname" class="form-control" required>
                                    </div>

                                    <!--Last Name-->
                                    <div class="col-sm-4">
                                        <label for="lnameLabel" class="col-form-label">Last Name</label>
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <input id="lnameLabel" name="lname" class="form-control" required>
                                    </div>

                                    
                                    <!--Last Name-->
                                    <div class="col-sm-3">
                                        <label for="emailLabel" class="col-form-label">Email</label>
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <input id="emailLabel" name="email" class="form-control" required>
                                    </div>

                                    <!--Password-->
                                    <div class="col-sm-3">
                                        <label for="passwordLabel" class="col-form-label">Password</label>
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <input id="passwordLabel" name="password" class="form-control" required >
                                    </div>
                                    
                                    <!--Roles-->
                                    <div class="col-sm-12">
                                        <label for="rolesLabel" class="col-form-label">Roles</label>
                                    </div>
                                    <div class="col-sm-4">        
                                        <select id="rolesLabel" class="form-select" name="roles">
                                            <option value="1">Owner</option>
                                            <option value="2">Admin</option>
                                        </select>    
                                    </div>
                                </div> 
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" value="Submit">Add</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!--Create Modal-->

        

        <!--Table List-->
        <div class="container-fluid mt-2 p-0">
            <table class="table table-hover">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>

               
                <tbody class="bg-white">
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop ->iteration }}</th>
                        <td>{{ $user->fname }} {{ $user->lname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_name }}</td>
                        <td>
                            <button class="btn btn-info text-white" type="button" data-bs-toggle="modal" data-bs-target="#showDetails-{{ $user->id }}">Details</button>
                            
                            <!-- Show Modal -->
                            <!--Pop up form-->
                            <div class="modal fade" id="showDetails-{{ $user->id }}" tabindex="-1" aria-labelledby="showDetailsLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark" >
                                            <h1 class="text-white display-6">{{ $user->fname }} {{ $user->lname }}</h1>
                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container bg-white">
                                                    <div class="row">    
                                                        <!--Last Name-->
                                                        <div class="col-sm-12">
                                                            <b>Email: </b>{{ $user->email }}
                                                        </div> 

                                                        <!--Password-->
                                                        <div class="col-sm-12">
                                                            <b>Password: </b>{{ $user->password }}
                                                        </div>
                                                        
                                                        <!--Roles-->
                                                        <div class="col-sm-12">
                                                            <b>Roles: </b>{{ $user->role_name }}
                                                        </div>
                                                    </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Show Modal-->


                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editUserForm-{{ $user->id }}">Edit</button>
                            
                            <!--Edit Modal-->
                            <div class="modal fade" id="editUserForm-{{ $user->id }}" tabindex="-1" aria-labelledby="editUserFormLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark" >
                                            <h1 class="text-white display-6">Edit Admin</h1>
                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            @if ($errors->any())
                                        <div class="alert alert-danger">
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul></div>
                                        @endif
                                        <form action="/login/user/{{ $user->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                        <div class="modal-body">
                                            <div class="container bg-white">
                                                    @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                        </ul>
                                                    </div>
                                                    @endif  
                                                    <div class="row">    
                                                        <!--First Name-->
                                                        <div class="col-sm-4">
                                                            <label for="fnameLabel" class="col-form-label">First Name</label>
                                                        </div>
                                                        <div class="col-sm-12 mb-1">
                                                            <input id="fnameLabel" name="fname" class="form-control" value="{{ $user->fname }}" required >
                                                        </div>

                                                        <!--Last Name-->
                                                        <div class="col-sm-4">
                                                            <label for="lnameLabel" class="col-form-label">Last Name</label>
                                                        </div>
                                                        <div class="col-sm-12 mb-1">
                                                            <input id="lnameLabel" name="lname" class="form-control" value="{{ $user->lname }}" required>
                                                        </div>

                                                        
                                                        <!--Email-->
                                                        <div class="col-sm-3">
                                                            <label for="emailLabel" class="col-form-label">Email</label>
                                                        </div>
                                                        <div class="col-sm-12 mb-1">
                                                            <input id="emailLabel" name="email" class="form-control" value="{{ $user->email }}" required>
                                                        </div>

                                                        <!--Password-->
                                                        <div class="col-sm-3">
                                                            <label for="passwordLabel" class="col-form-label">Password</label>
                                                        </div>
                                                        <div class="col-sm-12 mb-1">
                                                            <input id="passwordLabel" name="password" class="form-control" value="{{ $user->password }}" required >
                                                        </div>
                                                        
                                                        <!--Roles-->
                                                        <div class="col-sm-12">
                                                            <label for="rolesLabel" class="col-form-label">Roles</label>
                                                        </div>
                                                        <div class="col-sm-4">        
                                                            <select id="rolesLabel" class="form-select" name="roles">
                                                                @if (strcmp($user->role_name,"Admin")==0 )
                                                                    <option value="1">Owner</option>
                                                                    <option value="2" selected>Admin</option>  
                                                                @else
                                                                    <option value="1" selected>Owner</option>
                                                                    <option value="2">Admin</option>
                                                                @endif
                                                               
                                                            </select>    
                                                        </div>
                                                    </div> 
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" value="Submit">Save</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!--Edit Modal-->

                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteUserForm-{{ $user->id }}">Delete</button>
                            <!--Delete Modal-->
                            <div class="modal fade" id="deleteUserForm-{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserFormLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger" >
                                            <h1 class="text-white display-6">You want to delete this user?</h1>
                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/login/user/{{ $user->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <div class="modal-body">
                                            <div class="container bg-white">
                                                <div class="row">
                                                    <!--email-->
                                                    <div class="col-sm-12">
                                                        <b>First Name: </b>{{ $user->fname }}
                                                    </div> 

                                                    <!--Password-->
                                                    <div class="col-sm-12">
                                                        <b>Last Name: </b>{{ $user->lname }}
                                                    </div>

                                                    <!--email-->
                                                    <div class="col-sm-12">
                                                        <b>Email: </b>{{ $user->email }}
                                                    </div> 

                                                    <!--Password-->
                                                    <div class="col-sm-12">
                                                        <b>Password: </b>{{ $user->password }}
                                                    </div>
                                                    
                                                    <!--Roles-->
                                                    <div class="col-sm-12">
                                                        <b>Roles: </b>{{ $user->role_name }}
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
                        </td>
                    </tr>

                    

                @endforeach
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