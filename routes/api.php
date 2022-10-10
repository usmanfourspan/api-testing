<?php

use App\Http\Controllers\Api;
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

Route::post('auth/register', [Api\Auth\AuthController::class, 'register'])->name('auth.register');
Route::post('auth/login', [Api\Auth\AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => ['auth:sanctum']], function() {

});
Route::apiResource('projects', Api\Project\ProjectsController::class)->except('edit');




