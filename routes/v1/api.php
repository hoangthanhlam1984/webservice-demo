<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\Books\BookController;
use App\Http\Controllers\V1\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'show']);
Route::middleware('auth:sanctum')->patch('user', [AuthController::class, 'patch']);

Route::post('users', [UserController::class, 'store']);
Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::patch('users/{user}', [UserController::class, 'patch']);

Route::patch('login', [AuthController::class, 'login']);
Route::patch('logout', [AuthController::class, 'logout']);

Route::post('books', [BookController::class, 'store']);

Route::get('books', [BookController::class, 'index']);
Route::get('books/{book}', [BookController::class, 'show']);

Route::patch('books/{book}', [BookController::class, 'patch']);
Route::put('books/{book}', [BookController::class, 'update']);

Route::delete('books/{book}', [BookController::class, 'destroy']);
