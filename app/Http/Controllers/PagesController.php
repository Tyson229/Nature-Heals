<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\request as tool_request;

class PagesController extends Controller
{
    public function homepage(){
        return view('UserSide.welcome');
    }
    public function tools(){
        return view('UserSide.tools');
    }
    public function detailed(){
        return view('UserSide.detailed');
    }
    public function contact(){
        return view('UserSide.contact');
    }

    public function adminlogin(){
        if(Auth::user())
            return view('AdminSide.homepage');
        else    
            return view('AdminSide.login');
    }
   
    public function adminForgotPassword(){
        return view('AdminSide.forgotPassword');
    }

    public function adminResetPassword(){
        return view('AdminSide.resetPassword');
    }

    public function adminHome(){
        if(Auth::user())
        {
            $requests = tool_request::get();        
            $request_number = count($requests); 
            return view('AdminSide.homepage')->with('request_number',$request_number);
        }
        else
            return redirect()->route('login');    
    }
    public function adminTodoList(){
        if(Auth::user())
            return view('AdminSide.todoList');
        else
            return redirect()->route('login');
    }
    public function adminFeedback(){
        if(Auth::user()){
            if(Auth::user()->role_ID == 1)
                return view('AdminSide.feedback');
            else
                return back();
        }
        else{
            return redirect()->route('login');
        }
    }
}
