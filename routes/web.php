<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*User end*/

/*Route::get('/', function () {
    return view('UserSide.welcome');    
});*/

//Homepage
Route::get('/', [PagesController::class, 'homepage']);

//Assessment Tools
Route::get('/tools', [PagesController::class,'tools']);

//Detailed Tool
Route::get('/detailed', [PagesController::class,'detailed']);

//Contact Us
Route::get('/contact', [PagesController::class,'contact'])->name('contact.index'); 

//send information of contact us page to email
Route::post('send-contact-us', [ContactController::class,'sendContactUs'])->name('contact.send-information'); 


//Request page
Route::get('/request', [PagesController::class,'request']);

/**Admin end**/
Route::get('/login/forgotPassword', [PagesController::class,'adminForgotPassword']);
Route::get('/login/resetPassword', [PagesController::class,'adminresetPassword']);

Route::get('/login/home', [PagesController::class,'adminHome'])->name('admin.home');

Route::resource('login/user',UserController::class);
Route::resource('login/tools',ToolsController::class);

//pending tool request
Route::get('/login/request', [PagesController::class,'adminRequest']);
Route::get('/login/feedback', [PagesController::class,'adminFeedback']);
Route::get('/login/draft', [PagesController::class,'adminDraft']);

//todolist
Route::get('/login/todolist', [ToDoListController::class,'index'])->name('todolist.index');
Route::post('store-task', [ToDoListController::class, 'store'])->name('todolist.store');
Route::put('update-task/{id}', [ToDoListController::class, 'update'])->name('todolist.update');
Route::get('update-task-status/{id}', [ToDoListController::class, 'updateStatus'])->name('todolist.update-status');
Route::delete('delete-task/{id}', [ToDoListController::class, 'destroy'])->name('todolist.destroy');

Auth::routes();

  
