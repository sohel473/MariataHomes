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

// user routes
// get routes
Route::middleware('guest')->group(function () {
  Route::get('/login', [UserController::class, 'loginPage']);
  Route::get('/register', [UserController::class, 'registerPage']);
});

// post routes

Route::middleware('guest')->group(function () {
  Route::post('/login', [UserController::class, 'login']);
  Route::post('/register', [UserController::class, 'register']);
});
Route::post('/logout', [UserController::class, 'logout'])->middleware(('MustBeLoggedIn'));

// profile routes
// get routes
Route::get('/create_profile', [ProfileController::class, 'showCreateProfilePage'])->middleware(array('MustBeLoggedIn', 'PreventProfileRecreation'));
Route::get('/profile', [ProfileController::class, 'showProfilePage'])->middleware(array('MustBeLoggedIn', 'MustCreateProfile'));

// post routes
Route::post('/create_profile', [ProfileController::class, 'createProfile'])->middleware(array('MustBeLoggedIn', 'PreventProfileRecreation'));


// admin routes
Route::middleware('can:admin-access')->group(function () {
  // get routes
  // admin routes
  Route::get('/admin', [AdminController::class, 'showAdminPage']);
  // users routes
  Route::get('/create_user', [AdminController::class, 'showCreateUserPage']);
  Route::get('/users/{user}', [AdminController::class, 'showUserPage']);
  Route::get('/users/{user}/edit', [AdminController::class, 'showEditUserPage']);
  // admin users routes
  Route::get('/create_admin_user', [AdminController::class, 'showCreateAdminUserPage']);
  Route::get('/admin_users/{admin_user}', [AdminController::class, 'showAdminUserPage']);
  Route::get('/admin_users/{admin_user}/edit', [AdminController::class, 'showEditAdminUserPage']);
  // recommended sources routes
  Route::get('/create_recommended_source', [AdminController::class, 'showCreateRecommendedSourcePage']);
  Route::get('/recommended_sources/{recommended_source}', [AdminController::class, 'showRecommendedSourcePage']);
  Route::get('/recommended_sources/{recommended_source}/edit', [AdminController::class, 'showEditRecommendedSourcePage']);

  // // post, put, delete routes
  Route::post('/create_user', [AdminController::class, 'createUser']);
  Route::post('/create_admin_user', [AdminController::class, 'createAdminUser']);
  Route::post('/create_recommended_source', [AdminController::class, 'createRecommendedSource']);

  Route::put('/user/{user}', [AdminController::class, 'editUser']);
  Route::put('/admin_user/{admin_user}', [AdminController::class, 'editAdminUser']);
  Route::put('/recommended_source/{recommended_source}', [AdminController::class, 'editRecommendedSource']);

  Route::delete('/user/{user}', [AdminController::class, 'deleteUser']);
  Route::delete('/admin_user/{admin_user}', [AdminController::class, 'deleteAdminUser']);
  Route::delete('/recommended_source/{recommended_source}', [AdminController::class, 'deleteRecommendedSource']);
});





