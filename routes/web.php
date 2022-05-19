<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;

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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', [Controller::class, 'dashboard']);

// category
Route::get('/categorylist', [CategoryController::class, 'index']);
Route::get('/addcategory', [CategoryController::class, 'create']);
Route::post('/addcategory', [CategoryController::class, 'store']);

Route::get('/editcategory/{category}', [CategoryController::class, 'edit']);
Route::post('/editcategory/{category}', [CategoryController::class, 'update']);

Route::delete('/deletecategory/{category}', [CategoryController::class, 'destroy']);

// news
Route::get('/productlist', [TaskController::class, 'index']);
Route::post('/productBycategory', [TaskController::class, 'taskByCategory']);
Route::get('/addtask', [TaskController::class, 'create']);
Route::post('/addtask', [TaskController::class, 'store']);

Route::get('/edittask/{task}', [TaskController::class, 'edit']);
Route::post('/edittask/{task}', [TaskController::class, 'update']);

//a delete
Route::get('/deletetask/{task}', [TaskController::class, 'destroy']);
//method delete needs form
Route::delete('/deletetask/{task}', [TaskController::class, 'destroy']);

// users
Route::get('/users', [UserController::class, 'index']);
Route::post('/userByrole', [UserController::class, 'userByrole']);
Route::get('/adduser', [UserController::class, 'create']);
Route::post('/adduser', [UserController::class, 'store']);

Route::get('/edituser/{user}', [UserController::class, 'edit']);
Route::post('/edituser/{user}', [UserController::class, 'update']);

