<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\ApiCeLecturerController;
use App\Http\Controllers\ApiContactUsController;
use App\Http\Controllers\ApiFrontlinerController;
use App\Http\Controllers\ApiGenerationController;
use App\Http\Controllers\ApiLabscategoryController;
use App\Http\Controllers\ApiOpenprojectController;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\ApiRepositorylabsController;
use App\Http\Controllers\ApiWebsiteConfigurationController;
use App\Http\Controllers\ApiWebsiteGalleryController;
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

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('register', [ApiAuthController::class, 'register']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
    Route::post('forgot', [ApiAuthController::class, 'sendResetLink']);
    Route::post('reset_password/{token}', [ApiAuthController::class, 'resetPassword']);
    Route::post('me', [ApiAuthController::class, 'me']);
});

Route::group(['middleware' => 'api','prefix' => 'member'], function ($router) {
    Route::post('labs', [ApiAuthController::class, 'labs_list_member']);
    Route::post('labs/{repositorylabs:slug}', [ApiAuthController::class, 'labs_show_member']);
    Route::post('labs_create', [ApiAuthController::class, 'labs_create_member']);
    Route::post('labs_update/{repositorylabs:slug}', [ApiAuthController::class, 'labs_update_member']);
    Route::post('labs_delete/{repositorylabs:slug}', [ApiAuthController::class, 'labs_delete_member']);
    Route::post('labs_checkSlug', [ApiAuthController::class, 'labs_checkSlug']);
    Route::post('imagefolder', [ApiAuthController::class, 'imagefolder_list_member']);
    Route::post('imagefolder_create', [ApiAuthController::class, 'imagefolder_create_member']);
    Route::post('imagefolder_delete/{imagefolder:id}', [ApiAuthController::class, 'imagefolder_delete_member']);
    Route::post('ticket', [ApiAuthController::class, 'ticket_list_member']);
    Route::post('ticket/{ticket:slug}', [ApiAuthController::class, 'ticket_show_member']);
    Route::post('ticket_create', [ApiAuthController::class, 'ticket_create_member']);
    Route::post('ticket_checkSlug', [ApiAuthController::class, 'ticket_checkSlug']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/posts', ApiPostController::class);

Route::apiResource('/categories', ApiCategoryController::class);

Route::apiResource('/openprojects', ApiOpenprojectController::class);

Route::apiResource('/labs', ApiRepositorylabsController::class, ['parameters' => ['labs' => 'repositorylabs']]);

Route::apiResource('/labs-categories', ApiLabscategoryController::class, ['parameters' => ['labs-categories' => 'labscategory']]);

Route::apiResource('/generations', ApiGenerationController::class);

Route::apiResource('/frontliners', ApiFrontlinerController::class);

Route::apiResource('/websiteconfiguration', ApiWebsiteConfigurationController::class);

Route::apiResource('/websitegallery', ApiWebsiteGalleryController::class);

Route::apiResource('/lecturers', ApiCeLecturerController::class);

Route::post('contactus', [ApiContactUsController::class, 'store']);