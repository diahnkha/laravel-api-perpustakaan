<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\CategoryController;

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

Route::get('/author/list', [AuthorController::class, 'index']);
Route::get('/author/{id}/show', [AuthorController::class, 'show']);
Route::post('/author/store', [AuthorController::class, 'store']);
Route::post('/author/{id}/update', [AuthorController::class, 'update']);
Route::post('/author/{id}/delete', [AuthorController::class, 'destroy']);

Route::get('/book/list', [BookController::class, 'index']);
Route::get('/book/{id}/show', [BookController::class, 'show']);
Route::post('/book/store', [BookController::class, 'store']);
Route::post('/book/{id}/update', [BookController::class, 'update']);
Route::post('/book/{id}/delete', [BookController::class, 'destroy']);

Route::get('/category/list', [CategoryController::class, 'index']);
Route::get('/category/{id}/show', [CategoryController::class, 'show']);
Route::post('/category/store', [CategoryController::class, 'store']);
Route::post('/category/{id}/update', [CategoryController::class, 'update']);
Route::post('/category/{id}/delete', [CategoryController::class, 'destroy']);
