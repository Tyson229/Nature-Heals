<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return view('AdminSide.homepage');
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
