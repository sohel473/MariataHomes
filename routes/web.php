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
Route::post('/create_profile', [ProfileController::class, 'createProfile'])->middleware(('MustBeLoggedIn'));


// admin routes

Route::middleware('can:admin-access')->group(function () {
  // get routes
  Route::get('/admin', [AdminController::class, 'showAdminPage']);
  // Route::get('/user/{user}', [AdminController::class, 'showUserPage']);
  // Route::get('/user/{user}/edit', [AdminController::class, 'showEditUserPage']);

  // // post, put, delete routes
  // Route::post('/create_user', [AdminController::class, 'createUser']);
  // Route::put('/user/{user}', [AdminController::class, 'editUser']);
  // Route::delete('/user/{user}', [AdminController::class, 'deleteUser']);
});





