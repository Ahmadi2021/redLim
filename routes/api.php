<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Laravel\Passport\Passport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Add this line at the top of routes/api.php


Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('profile', [App\Http\Controllers\User\UserController::class, 'show']);
    Route::put('profile', [App\Http\Controllers\User\UserController::class,'update']);
    Route::post('posts', [App\Http\Controllers\Post\PostController::class, 'store']);
    Route::get('posts', [App\Http\Controllers\Post\PostController::class, 'index']);
    Route::get('posts/user/{id}', [App\Http\Controllers\Post\PostController::class, 'indexUserPosts']);
    Route::put('posts/{id}', [App\Http\Controllers\Post\PostController::class, 'update']);
    Route::delete('posts/{id}', [App\Http\Controllers\Post\PostController::class, 'destroy']);
    Route::post('comments', [App\Http\Controllers\Comment\CommentController::class, 'store']);
    Route::get('posts/{postId}/comments', [App\Http\Controllers\Comment\CommentController::class, 'indexPostComments']);
});


