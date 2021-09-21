@extends('layouts.adminLayout')

@section('style')
<style>
    html{
        font-size: 1.2rem;
    }
</style>
@endsection

@section('nav-bar')
@if(auth()->user()->role->role_name == 'Owner')

    <a class="nav-link" href="/login/home">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Home
    </a>
    @if(Auth::user()->role_ID == 1)
    <a class="nav-link  " href="/login/user">
        <div class="sb-nav-link-icon"><i class="fa fa-user-circle"></i></div>
        User Management
    </a> 
    @endif
    <a class="nav-link " href="/login/tools">
        <div class="sb-nav-link-icon"><i class="fa fa-suitcase"></i></div>
        Assessment Tools
    </a>
    @if(Auth::user()->role_ID == 1) 
    <a class="nav-link  " href="/login/request">
        <div class="sb-nav-link-icon"><i class="fa fa-paper-plane"></i></div>
      Tool Request
    </a>
    @endif
    <a class="nav-link bg-primary text-white" href="/login/todolist">
        <div class="sb-nav-link-icon"><i class="fa fa-server"></i></div>
        To-do List 
    </a> 
    @if(Auth::user()->role_ID == 1)
    <a class="nav-link" href="/login/feedback">
        <div class="sb-nav-link-icon"><i class="fa fa-life-ring"></i></div>
        Feedback
    </a> 
    @endif
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

    <a class="nav-link bg-primary text-white" href="/login/todolist">
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
                    <form id="create-task-form" method="POST" action="{{route('todolist.store')}}"> 
                        @csrf     
                        <div class="modal-header bg-dark" >
                            <h1 class="text-white display-6">Add Task</h1>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container bg-white">
                                @if ($errors->hasBag('store'))
                                    <div class="alert alert-danger">
                                        @foreach ($errors->store->all() as $error)
                                        <ul>
                                            <li>{{ $error }}</li>
                                        </ul>
                                        @endforeach
                                    </div>
                                @endif
                                    <div class="row">    
                                        <!--Task-->
                                        <div class="col-sm-2">
                                            <label for="taskLabel" class="col-form-label">Task</label>
                                        </div>
                                        <div class="col-sm-10 mb-3">
                                            <textarea name="task_name" id="taskLabel" class="form-control" rows="1" placeholder="Write your task here..."></textarea>
                                        </div>

                                        <!--Priortity-->
                                        <div class="col-sm-2">
                                            <label for="priorityLabel" class="col-form-label">Priority</label>
                                        </div>
                                        <div class="col-sm-4">        
                                            <select name="priority" id="priorityLabel" class="form-select">
                                                <option selected value="High">High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                            </select>    
                                        </div>
                                    
                                    </div> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal-->

        <!--Message-->
       <br> @if(session('message'))
            <div class="alert alert-success mb-1" role="alert">
                <i class="fas fa-check-circle"></i>
                <strong>
                    {{ session('message')}}            
                </strong>
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!--Message--> 

        <!--Table List-->
        <div class="container-fluid mt-2 p-0">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Checked</th>
                        <th scope="col">Task</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Creator</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                @forelse ($tasks as $task)
                    <tr>
                        <th scope="row">
                            @if($task->completed === 0)
                                <a href="{{route('todolist.update-status', ['id' => $task->id])}}" class="btn btn-outline-success"><i class="fas fa-check"></i></a>
                            @else
                                <a href="{{route('todolist.update-status', ['id' => $task->id])}}" class="btn btn-success"><i class="fas fa-check"></i></a>
                            @endif
                        </th>
                        <td class="col-sm-4">{{$task->task_name}}</td>
                        <td>{{$task->priority}}</td>
                        <td>{{$task->creator->fname . ' ' . $task->creator->lname}}</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editTaskForm-{{$task->id}}">Edit</button>
                            <button data-bs-toggle="modal" data-bs-target="#deleteTaskForm-{{$task->id}}" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <!--update modal-->
                    <div class="modal fade" id="editTaskForm-{{$task->id}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editTaskFormLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal-lg">
                                <form id="update-task-form" method="POST" action={{route('todolist.update', ['id' => $task->id])}}> 
                                @csrf
                                @method('PUT')     
                                    <div class="modal-header bg-dark" >
                                        <h1 class="text-white display-6">Task Details</h1>
                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container bg-white">
                                            <div class="row">    
                                                <!--Task-->
                                                <div class="col-sm-2">
                                                    <label for="taskLabel" class="col-form-label">Task</label>
                                                </div>
                                                <div class="col-sm-10 mb-3">
                                                    <textarea name="task_name" id="taskLabel" class="form-control" rows="1" placeholder="Write your task here...">{{$task->task_name}}</textarea>
                                                </div>

                                                <!--Priortity-->
                                                <div class="col-sm-2">
                                                    <label for="priorityLabel" class="col-form-label">Priority</label>
                                                </div>
                                                <div class="col-sm-4">        
                                                    <select name="priority" id="priorityLabel" class="form-select" value="{{$task->priority}}">
                                                        @if(strcmp($task->priority, "High") == 0)
                                                            <option selected value="High">High</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="Low">Low</option>
                                                        @elseif(strcmp($task->priority, "Medium") == 0)
                                                            <option value="High">High</option>
                                                            <option value="Medium" selected>Medium</option>
                                                            <option value="Low">Low</option>
                                                        @else
                                                            <option value="High">High</option>
                                                            <option value="Medium" selected>Medium</option>
                                                            <option value="Low" selected>Low</option>
                                                        @endif
                                                    </select>    
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Update Modal-->

                    <!--Delete Modal-->
                    <div class="modal fade" id="deleteTaskForm-{{ $task->id }}" tabindex="-1" aria-labelledby="deleteUserFormLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger" >
                                    <h1 class="text-white display-6">You want to delete this task?</h1>
                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('todolist.destroy', ['id' => $task->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <div class="modal-body">
                                    <div class="container bg-white">
                                        <div class="row">
                                            <!--task name-->
                                            <div class="col-sm-12">
                                                <b>Task Name: </b>{{ $task->task_name }}
                                            </div> 

                                            <!--priority-->
                                            <div class="col-sm-12">
                                                <b>Priority: </b>@if(strcmp($task->priority, "High") == 0) High @elseif(strcmp($task->priority, "Medium") == 0) Medium @else Low @endif
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
                @empty
                    <tr><td colspan="5" class="text-center">No Records Found</td></tr>
                @endforelse
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-7 offset-sm-5">
                    {{ $tasks->links() }}
                </div>    
            </div>
        </div>
        <!--Table List-->
    </main>
@endsection