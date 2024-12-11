
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\TaskController;

Route::get('/', function () {
    return view('welcome');
});
Route::controller(AuthController::class)->group(function () {
    Route::post('api/register', 'register');
    Route::post('api/login', 'login');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('api/tasks', TaskController::class);
});
