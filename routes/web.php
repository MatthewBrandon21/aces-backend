<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CelecturerController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\DashboardAdminImageFolder;
use App\Http\Controllers\DashboardAdminTicket;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardFrontlinerController;
use App\Http\Controllers\DashboardGenerationController;
use App\Http\Controllers\DashboardLabscategoryController;
use App\Http\Controllers\DashboardMemberImageFolder;
use App\Http\Controllers\DashboardMemberRepositoryPost;
use App\Http\Controllers\DashboardOpenprojectController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardRepositorylabsController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardUserProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WebsiteconfigurationController;
use App\Http\Controllers\WebsitegalleryController;
use Illuminate\Support\Facades\Route;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home', [
//         "title" => "Home"
//     ]);
// });

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About"
    ]);
});

Route::get('/blog', [PostController::class, 'index']);

Route::get('/blog/{post:slug}', [PostController::class, 'detail']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/categories/{category:slug}', [CategoryController::class, 'detail']);

Route::get('/authors/{author:username}', function(User $author){
    return view('posts', [
        'title' => "Post by Author : $author->name",
        'posts' => $author->posts->load('category', 'author')
    ]);
});

Route::get('/labs', function () {
    return view('labs', [
        "title" => "Labs"
    ]);
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');

Route::post('/register', [AuthController::class, 'store']);

Route::get('/forgot-password', [AuthController::class, 'forgot'])->name('forgot')->middleware('guest');

Route::get('/reset-password', [AuthController::class, 'reset'])->name('reset')->middleware('guest');

Route::get('/password/forgot',[ResetPasswordController::class,'showForgotForm'])->name('forgot.password.form');

Route::post('/password/forgot',[ResetPasswordController::class,'sendResetLink'])->name('forgot.password.link');

Route::get('/password/reset/{token}',[ResetPasswordController::class,'showResetForm'])->name('reset.password.form');

Route::post('/password/reset',[ResetPasswordController::class,'resetPassword'])->name('reset.password');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::post('/dashboard/posts/publishConf/{post:slug}', [DashboardPostController::class, 'publishConf'])->middleware('isadmin');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('isadmin');

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('isadmin');

Route::get('/dashboard/categories/checkSlug', [DashboardCategoryController::class, 'checkSlug'])->middleware('isadmin');

Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('isadmin');

Route::post('/dashboard/users/changeRole/{user:username}', [DashboardUserController::class, 'changeRole'])->middleware('isadmin');

Route::post('/dashboard/users/banUser/{user:username}', [DashboardUserController::class, 'banUser'])->middleware('isadmin');

Route::resource('/dashboard/users', DashboardUserController::class)->middleware('isadmin');

Route::post('/dashboard/profile/changePassword/{user:username}', [DashboardUserProfileController::class, 'changePassword'])->middleware('auth');

Route::resource('/dashboard/profile', DashboardUserProfileController::class)->middleware('auth');

Route::post('/dashboard/openproject/publishConf/{openproject:slug}', [DashboardOpenprojectController::class, 'publishConf'])->middleware('isadmin');

Route::get('/dashboard/openproject/checkSlug', [DashboardOpenprojectController::class, 'checkSlug'])->middleware('isadmin');

Route::resource('/dashboard/openproject', DashboardOpenprojectController::class)->middleware('isadmin');

Route::post('/dashboard/labs/publishConf/{repositorylabs:slug}', [DashboardRepositorylabsController::class, 'publishConf'])->middleware('isadmin');

Route::get('/dashboard/labs/checkSlug', [DashboardRepositorylabsController::class, 'checkSlug'])->middleware('isadmin');

Route::resource('/dashboard/labs', DashboardRepositorylabsController::class, ['parameters' => ['labs' => 'repositorylabs']])->middleware('isadmin');

Route::get('/dashboard/memberlabs/checkSlug', [DashboardMemberRepositoryPost::class, 'checkSlug'])->middleware('auth');

Route::resource('/dashboard/memberlabs', DashboardMemberRepositoryPost::class, ['parameters' => ['memberlabs' => 'repositorylabs']])->middleware('auth');

Route::get('/dashboard/ticket/checkSlug', [TicketController::class, 'checkSlug'])->middleware('auth');

Route::resource('/dashboard/ticket', TicketController::class, ['parameters' => ['ticket' => 'ticket']])->middleware('auth');

Route::resource('/dashboard/admin-ticket', DashboardAdminTicket::class, ['parameters' => ['admin-ticket' => 'ticket']])->middleware('isadmin');

Route::resource('/dashboard/admin-contactus', ContactusController::class, ['parameters' => ['admin-contactus' => 'contactus']])->middleware('isadmin');

Route::resource('/dashboard/imagefolder', DashboardMemberImageFolder::class, ['parameters' => ['imagefolder' => 'imagefolder']])->middleware('auth');

Route::resource('/dashboard/adminimagefolder', DashboardAdminImageFolder::class, ['parameters' => ['imagefolder' => 'imagefolder']])->middleware('isadmin');

Route::resource('/dashboard/websitegallery', WebsitegalleryController::class, ['parameters' => ['websitegallery' => 'websitegallery']])->middleware('isadmin');

Route::resource('/dashboard/websiteconfiguration', WebsiteconfigurationController::class, ['parameters' => ['websiteconfiguration' => 'websiteconfiguration']])->middleware('isadmin');

Route::get('/dashboard/labs-categories/checkSlug', [DashboardLabscategoryController::class, 'checkSlug'])->middleware('isadmin');

Route::resource('/dashboard/labs-categories', DashboardLabscategoryController::class, ['parameters' => ['labs-categories' => 'labscategory']])->middleware('isadmin');

Route::get('/dashboard/generations/checkSlug', [DashboardGenerationController::class, 'checkSlug'])->middleware('isadmin');

Route::resource('/dashboard/generations', DashboardGenerationController::class)->middleware('isadmin');

Route::get('/dashboard/frontliners/checkSlug', [DashboardFrontlinerController::class, 'checkSlug'])->middleware('isadmin');

Route::resource('/dashboard/frontliners', DashboardFrontlinerController::class)->middleware('isadmin');

Route::get('/dashboard/lecturers/checkSlug', [CelecturerController::class, 'checkSlug'])->middleware('isadmin');

Route::resource('/dashboard/lecturers', CelecturerController::class, ['parameters' => ['lecturers' => 'celecturer']])->middleware('isadmin');
