<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function request(){
        return view('UserSide.request');
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
        if(auth()->user())
        return view('AdminSide.homepage');
        else
        return redirect()->route('login');
    }

    public function adminRequest(){
        if(auth()->user())
        return view('AdminSide.pendingRequest');
        else
        return redirect()->route('login');
    }
    public function adminTodoList(){
        if(auth()->user())
        return view('AdminSide.todoList');
        else
        return redirect()->route('login');
    }
    public function adminFeedback(){
        if(auth()->user())
        return view('AdminSide.feedback');
        else
        return redirect()->route('login');
    }
    public function adminDraft(){
        if(auth()->user())
        return view('AdminSide.draft');
        else
        return redirect()->route('login');
    }

}
