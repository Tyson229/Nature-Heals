<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\Tools_feedback;
use App\Http\Controllers\UserRequestController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserToolController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\ContactController;



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
//Homepage

Auth::routes();
Route::get('/', [PagesController::class, 'homepage']);
Route::get('/home', [PagesController::class, 'adminHomepage']);

//Assessment Tools
Route::get('/tools', [UserToolController::class,'tools']);
Route::post('search-tools', [UserToolController::class,'search'])->name('tools.search');

//Detailed Tool
Route::get('detailed/{id}', [UserToolController::class,'detailed'])->name('tools.detailed');
Route::post('save-feedback/{id}', [ToolsController::class, 'storeFeedback'])->name('tools.store-feedback');

//Contact Us
Route::get('/contact', [PagesController::class,'contact'])->name('contact.index'); 

//send information of contact us page to email
Route::post('send-contact-us', [ContactController::class,'sendContactUs'])->name('contact.send-information'); 


//Request page
Route::resource('/request', UserRequestController::class);

/**Admin end**/
Route::get('/login/forgotPassword', [PagesController::class,'adminForgotPassword']);
Route::get('/login/resetPassword', [PagesController::class,'adminresetPassword']);

Route::get('/login/home', [PagesController::class,'adminHome'])->name('admin.home');

Route::resource('login/user',UserController::class);

Route::resource('login/tools',ToolsController::class);

Route::resource('login/request',AdminRequestController::class);

Route::resource('login/draft', DraftController::class);

Route::get('/login/feedback', [FeedbackController::class,'index'])->name('feedback.index');
Route::delete('delete-feedback/{id}', [FeedbackController::class,'destroy'])->name('feedback.delete');

//todolist
Route::get('/login/todolist', [ToDoListController::class,'index'])->name('todolist.index');
Route::post('store-task', [ToDoListController::class, 'store'])->name('todolist.store');
Route::put('update-task/{id}', [ToDoListController::class, 'update'])->name('todolist.update');
Route::get('update-task-status/{id}', [ToDoListController::class, 'updateStatus'])->name('todolist.update-status');
Route::delete('delete-task/{id}', [ToDoListController::class, 'destroy'])->name('todolist.destroy');

Auth::routes();

  
