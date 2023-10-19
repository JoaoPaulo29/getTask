<?php

use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\Users\UserAutenticationController;
use App\Http\Controllers\API\Users\UserRegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(
    
    function(){
        Route::post('/register',[UserRegisterController::class,'register']);
        Route::get('/logout',[UserAutenticationController::class,'logout'])->middleware('auth:sanctum');
        Route::post('/login',[UserAutenticationController::class,'login']);
    }
);

Route::group(['middleware' => 'auth:sanctum'], function () { 
    Route::prefix('task')->group(
        function(){
            Route::get('/show/{id}', [TaskController::class, 'show']);
            Route::get('/all/from/User/{id}', [TaskController::class, 'allTaskUser']);
            Route::get('/all/from/User/{id}', [TaskController::class, 'allForStatusUser']);
            Route::get('/all/for/status', [TaskController::class, 'allForStatus']);
            Route::put('/update/{id}', [TaskController::class, 'changeStatus']);
            Route::post('/create', [TaskController::class, 'createTask'])->middleware('admin');
        }
    );
});

Route::group(['middleware' => 'admin'], function () {
    // Suas rotas protegidas aqui
});

Route::get('/teste', function(){
    return 1;
});


