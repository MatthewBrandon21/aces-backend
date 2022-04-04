<?php

use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\ApiFrontlinerController;
use App\Http\Controllers\ApiGenerationController;
use App\Http\Controllers\ApiLabscategoryController;
use App\Http\Controllers\ApiOpenprojectController;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\ApiRepositorylabsController;
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

Route::apiResource('/posts', ApiPostController::class);

Route::apiResource('/categories', ApiCategoryController::class);

Route::apiResource('/openprojects', ApiOpenprojectController::class);

Route::apiResource('/repositorylabs', ApiRepositorylabsController::class);

Route::apiResource('/labscategories', ApiLabscategoryController::class);

Route::apiResource('/generations', ApiGenerationController::class);

Route::apiResource('/frontliners', ApiFrontlinerController::class);