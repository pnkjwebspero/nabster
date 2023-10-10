<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UsersController;
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


Route::post('register', [AuthController::class, 'register']);
Route::put('username', [AuthController::class, 'username']);

// User login
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => ['web']], function () {
    Route::get('login/{provider}', [AuthController::class, 'redirect']);
    Route::get('login/{provider}/callback',[AuthController::class, 'Callback']);
});


Route::post('profile/required', [UsersController::class, 'profileRequired']);
Route::post('profile/optional', [UsersController::class, 'profileOptional']);



//Testing API
Route::get('testing', [UsersController::class, 'testing']);

