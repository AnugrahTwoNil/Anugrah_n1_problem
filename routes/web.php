<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts-report', [PostController::class, 'report'])->name('posts.report');
