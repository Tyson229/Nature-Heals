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
        return view('AdminSide.homepage');
    }

    public function adminTools(){
        return view('AdminSide.tools');
    }
    public function adminRequest(){
        return view('AdminSide.pendingRequest');
    }
    public function adminTodoList(){
        return view('AdminSide.todoList');
    }
    public function adminFeedback(){
        return view('AdminSide.feedback');
    }
    public function adminDraft(){
        return view('AdminSide.draft');
    }
}
