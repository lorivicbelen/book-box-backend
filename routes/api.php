<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// book
Route::apiResource('books', BookController::class);
Route::get('/authors/{id}/books', [BookController::class, 'getBooksByAuthor']);
Route::post('/books/{id}/upload-cover-photo', [BookController::class, 'uploadCoverPhoto']);

// author
Route::apiResource('authors', AuthorController::class);

// category
Route::apiResource('categories', CategoryController::class);

// genre
Route::apiResource('genres', GenreController::class);

// comment
Route::post('/comments', [CommentController::class, 'store']);
Route::get('/books/{id}/comments', [CommentController::class, 'getCommentsByBooks']);
Route::post('comments/{id}', [CommentController::class, 'destroy']);


