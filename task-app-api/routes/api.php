<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => '/v1'], function($router){
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::get('/task', [TaskController::class, 'getDataTask']);
    Route::post('/task', [TaskController::class, 'addTask']);
    Route::get('/task/{taskId}', [TaskController::class, 'singleTask']);
    Route::put('/task/{taskId}', [TaskController::class, 'updateTask']);
    Route::delete('/task/{taskId}', [TaskController::class, 'deleteTask']);
});
