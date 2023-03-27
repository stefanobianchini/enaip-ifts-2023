<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//http://localhost:8000/api

//POST http://localhost:8000/api/users
Route::post('/users', [UserController::class, 'create']);
//DELETE http://localhost:8000/api/users/7 
Route::delete('/users/{id}', [UserController::class, 'delete']);
//GET http://localhost:8000/api/users/3
Route::get('/users/{id}', [UserController::class, 'read']);
//GET http://localhost:8000/api/users
Route::get('/users', [UserController::class, 'readAll']);
//PUT http://localhost:8000/api/users/22
Route::put('/users/{id}', [UserController::class, 'update']);
