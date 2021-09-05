<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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
Route::get('/contact', [PagesController::class,'contact']);

//Request page
Route::get('/request', [PagesController::class,'request']);

/**Admin end**/
Route::get('/login/home', [PagesController::class,'adminHome']);
Route::get('/login/user', [PagesController::class,'adminUser']);
Route::get('/login/tools', [PagesController::class,'adminTools']);
Route::get('/login/request', [PagesController::class,'adminRequest']);
Route::get('/login/todolist', [PagesController::class,'adminTodoList']);
Route::get('/login/feedback', [PagesController::class,'adminFeedback']);
Route::get('/login/draft', [PagesController::class,'adminDraft']);

Route::get('/test', [PagesController::class,'test']);
