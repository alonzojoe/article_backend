<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CommentVoteController;


Route::group(['prefix' => '/auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/me', [AuthController::class, 'me']);
});

Route::group(['prefix' => '/article'], function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::post('/create', [ArticleController::class, 'store']);
    Route::get('/{id}', [ArticleController::class, 'show']);
    Route::patch('/{id}', [ArticleController::class, 'update']);
    Route::delete('/{id}', [ArticleController::class, 'destroy']);
});

Route::group(['prefix', '/cast'], function () {
    Route::get('/{id}', [CommentVoteController::class, 'getComments']);
    Route::post('/comment', [CommentVoteController::class, 'comment']);
    Route::post('/vote', [CommentVoteController::class, 'vote']);
});
