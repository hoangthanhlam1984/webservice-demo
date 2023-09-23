<?php

use App\Http\Controllers\V1\Books\BookController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('books', [BookController::class, 'store']);

Route::get('books', [BookController::class, 'index']);
Route::get('books/{book}', [BookController::class, 'show']);

Route::patch('books/{book}', [BookController::class, 'patch']);
Route::put('books/{book}', [BookController::class, 'update']);

Route::delete('books/{book}', [BookController::class, 'destroy']);
