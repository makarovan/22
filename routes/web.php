<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;

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

Route::get('/', [TaskController::class, 'listLimit3']);

Route::get('/show/{task}', [TaskController::class, 'show'])->name('task.show');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/news', [CategoryController::class, 'listMenu']);
Route::get('/news/{category}', [CategoryController::class, 'newsByCategory']);

Route::post('/sortNews', [CategoryController::class, 'sortNews']);
Route::post('/search', [CategoryController::class, 'search']);

Route::get('/register', [UserController::class, 'formRegister']);
Route::post('/register', [UserController::class, 'storeRegister']);

Route::group(['middleware'=>['auth']],function(){
    //for all auth users
    Route::get('/dashboard',[Controller::class,'dashboard'])->name('dashboard');
    //admin, manager
    Route::middleware('manager')->group(function(){
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
        //delete ссылкой
        Route::get('/deletetask/{task}', [TaskController::class, 'destroy']);
        //delete form
        Route::delete('/deletetask/{task}', [TaskController::class, 'destroy']);

        //comments
        Route::get('/comments', [CommentController::class, 'index']);
        Route::get('deletecomment/{comment}', [CommentController::class, 'destroy']);
    });
    //admin only
    Route::middleware('admin')->group(function(){
        // users
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/userByrole', [UserController::class, 'userByrole']);
        Route::get('/adduser', [UserController::class, 'create']);
        Route::post('/adduser', [UserController::class, 'store']);
    });
    //for users
    Route::get('/profile/{user}', [UserController::class, 'edit']);
    Route::get('/edituser/{user}', [UserController::class, 'edit']);
    Route::post('/edituser/{user}', [UserController::class, 'update']);
});

//for non auth users login + logout
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);//обработка формы логин
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');