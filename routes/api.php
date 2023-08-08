<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class,'logout']);
    Route::get('/me',[AuthenticationController::class,'me']);
    Route::post('/posts', [PostController::class,'store']);
    Route::patch('/{id}/posts', [PostController::class,'update'])->middleware('own-post');
    Route::delete('/{id}/posts', [PostController::class,'destroy'])->middleware('own-post');

    Route::post('/comment', [CommentController::class,'store']);
    Route::patch('/comment/{id}', [CommentController::class,'update'])->middleware('own-comment');
    Route::delete('/comment/{id}', [CommentController::class,'destroy'])->middleware('own-comment');
});
Route::get('/posts', [PostController::class, 'index']);
Route::get('/{id}/posts', [PostController::class, 'show']);
Route::get('/{id}/posts2', [PostController::class, 'show2']);
Route::post('/login', [AuthenticationController::class,'login']);

