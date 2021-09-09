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

    public function adminHome(){
        return view('AdminSide.homepage');
    }

   /* public function adminUser(){
        return view('AdminSide.userManagement');
    }*/

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

    public function test(){
        return view('UserSide.test');
    }
}
