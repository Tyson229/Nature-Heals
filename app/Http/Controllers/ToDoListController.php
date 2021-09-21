<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\todolist as ToDoListModel;
use Illuminate\Support\Facades\Validator;

class ToDoListController extends Controller
{
    /**
     * display the listing of the resource
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = ToDoListModel::with('creator')->orderBy('completed', 'ASC')->paginate(10);
        return view('AdminSide.todoList', compact('tasks'));
    }

    
    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(),[
            'task_name' => 'required',
            'priority' => 'required',
    
        ],[
            'task_name.required' => 'Task Name is required',
            'priority.required' => 'Priority is required',
        ]);

        if($validator->fails()){
            return redirect()->route('todolist.index')->withErrors($validator,'store')->withInput();
        }


        $task = new ToDoListModel();
        $task->task_name = $request->task_name;
        $task->priority = $request->priority;
        $task->completed = 0;
        $task->user_id = auth()->user()->id;

        $task->save();

        return back()->with('message', 'Successfully Created Task!');
    }

    
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'task_name' => 'required',
            'priority' => 'required',
        ],[
            'task_name.required' => 'Task Name is required',
            'priority.required' => 'Priority is required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator,'update')->with('id',$id);
        }

        $task = ToDoListModel::find($id);
        $task->task_name = $request->task_name;
        $task->priority = $request->priority;
        $task->updated_at = now();

        $task->save();

        return back()->with('message', 'Successfully Updated Task!');

    }


    
    public function updateStatus($id)
    {
        $task =ToDoListModel::find($id);
        $task->completed = !$task->completed;
        $task->save();
        return back()->with('message', 'Successfully Changed Task Status!');
    }


    
    public function destroy($id)
    {
        $task =ToDoListModel::find($id);
        $task->delete();
        return back()->with('message', 'Successfully Deleted Task!');
    }
}