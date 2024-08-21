<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    $posts = Post::orderBy('created_at')->get();
    return view('homepage', compact('posts'));
});

Route::post('post/create', [PostController::class, 'create'])->name('post.create');

// Route::post('/', function () {
//     return view('homepage');
// })->name('post.create');
