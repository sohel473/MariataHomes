<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'showHomePage'])->middleware(('MustCreateProfile'));

// guest routes
Route::middleware('guest')->group(function () {
  // user routes
  // get routes
  Route::get('/login', [UserController::class, 'loginPage']);
  Route::get('/register', [UserController::class, 'registerPage']);
  // post routes
  Route::post('/login', [UserController::class, 'login']);
  Route::post('/register', [UserController::class, 'register']);
});

// auth routes
Route::middleware(('MustBeLoggedIn'))->group(function () {
  Route::post('/logout', [UserController::class, 'logout']);

  // profile routes
  // get routes
  Route::get('/create_profile', [ProfileController::class, 'showCreateProfilePage'])->middleware('PreventProfileRecreation');
  // post routes
  Route::post('/create_profile', [ProfileController::class, 'createProfile'])->middleware('PreventProfileRecreation');

  Route::get('/profile', [ProfileController::class, 'showProfilePage'])->middleware('MustCreateProfile');
});

// admin routes
Route::middleware('can:admin-access')->group(function () {
  // get routes
  // admin routes
  Route::get('/admin', [AdminController::class, 'showAdminPage']);

  Route::get('/admin/download_clients_report', [AdminController::class, 'downloadClientsReport'])->name('admin.download_clients_report');
  Route::get('/admin/download_admin_users_report', [AdminController::class, 'downloadAdminUsersReport'])->name('admin.download_admins_report');
  Route::get('/admin/download_recommended_sources_report', [AdminController::class, 'downloadRecommendedSourcesReport'])->name('admin.download_sources_report');


  // users routes
  Route::get('/create_user', [AdminController::class, 'showCreateUserPage']);
  Route::get('/user/{user}', [AdminController::class, 'showUserPage']);
  Route::get('/user/{user}/edit', [AdminController::class, 'showEditUserPage']);
  // admin users routes
  Route::get('/create_admin_user', [AdminController::class, 'showCreateAdminUserPage']);
  Route::get('/admin_user/{admin_user}', [AdminController::class, 'showAdminUserPage']);
  Route::get('/admin_user/{admin_user}/edit', [AdminController::class, 'showEditAdminUserPage']);
  // recommended sources routes
  Route::get('/create_recommended_source', [AdminController::class, 'showCreateRecommendedSourcePage']);
  Route::get('/recommended_source/{recommended_source}', [AdminController::class, 'showEditRecommendedSourcePage']);
  Route::get('/recommended_source/{recommended_source}/edit', [AdminController::class, 'showEditRecommendedSourcePage']);

  // // post, put, delete routes
  Route::post('/create_user', [AdminController::class, 'createUser'])->name('users.store');
  Route::post('/create_admin_user', [AdminController::class, 'createAdminUser'])->name('admin_users.store');
  Route::post('/create_recommended_source', [AdminController::class, 'createRecommendedSource'])->name('recommended_sources.store');

  Route::put('/user/{user}', [AdminController::class, 'editUser'])->name('users.update');
  Route::put('/admin_user/{admin_user}', [AdminController::class, 'editAdminUser'])->name('admin_users.update');
  Route::put('/recommended_source/{recommended_source}', [AdminController::class, 'editRecommendedSource'])->name('recommended_sources.update');

  Route::delete('/user/{user}', [AdminController::class, 'deleteUser']);
  Route::delete('/admin_user/{admin_user}', [AdminController::class, 'deleteAdminUser']);
  Route::delete('/recommended_source/{recommended_source}', [AdminController::class, 'deleteRecommendedSource']);

});