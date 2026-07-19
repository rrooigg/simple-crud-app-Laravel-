<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //returns all posts from all users
    // $posts = Post::all(); 

    //gets posts only from current authenticated user
    // $posts = Post::where('user_id', auth()->id())->get(); 

    //below starts from perspective of user while above starts with perspective of post

    //shows user post relationship
    $posts = [];
    //check if the user is logged in then show them their posts
    if (Auth::check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get(); 
    }

    return view('home', ['posts' => $posts]);
});
Route::post('/register', [UserController::class, 'register']); 
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']); 

//blog posts
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);