<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ToolsController;
<<<<<<< HEAD
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
=======
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserToolController;
>>>>>>> origin/HaoBranch


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
<<<<<<< HEAD

/*Route::get('/', function () {
    return view('UserSide.welcome');    
});*/

=======
>>>>>>> origin/HaoBranch
//Homepage
Route::get('/', [PagesController::class, 'homepage']);

//Assessment Tools
Route::get('/tools', [UserToolController::class,'tools']);

//Detailed Tool
Route::get('detailed/{id}', [UserToolController::class,'detailed'])->name('tools.detailed');
Route::post('save-feedback/{id}', [ToolsController::class, 'storeFeedback'])->name('tools.store-feedback');

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
<<<<<<< HEAD
Route::get('/login/feedback', [PagesController::class,'adminFeedback']);
=======
Route::get('/login/todolist', [PagesController::class,'adminTodoList']);

Route::get('/login/feedback', [FeedbackController::class,'index'])->name('feedback.index');
Route::delete('delete-task/{id}', [FeedbackController::class,'destroy'])->name('feedback.delete');

>>>>>>> origin/HaoBranch
Route::get('/login/draft', [PagesController::class,'adminDraft']);

//todolist
Route::get('/login/todolist', [ToDoListController::class,'index'])->name('todolist.index');
Route::post('store-task', [ToDoListController::class, 'store'])->name('todolist.store');
Route::put('update-task/{id}', [ToDoListController::class, 'update'])->name('todolist.update');
Route::get('update-task-status/{id}', [ToDoListController::class, 'updateStatus'])->name('todolist.update-status');
Route::delete('delete-task/{id}', [ToDoListController::class, 'destroy'])->name('todolist.destroy');

Auth::routes();

  
