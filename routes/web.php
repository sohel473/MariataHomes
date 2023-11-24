<?php

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
Route::get('/login', [UserController::class, 'loginPage']);
Route::get('/register', [UserController::class, 'registerPage']);

// post routes
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->middleware(('MustBeLoggedIn'));

// profile routes

// get routes
Route::get('/create_profile', [ProfileController::class, 'showCreateProfilePage'])->middleware(('MustBeLoggedIn'));
Route::get('/profile', [ProfileController::class, 'showProfilePage'])->middleware(array('MustBeLoggedIn', 'MustCreateProfile'));

// post routes
Route::post('/profile', [UserController::class, 'updateProfile'])->middleware(('MustBeLoggedIn'));


// admin routes
// get routes
Route::get('/admin', [AdminController::class, 'showAdminPage']);
Route::get('/user/{user}', [AdminController::class, 'showUserPage']);
Route::get('/user/{user}/edit', [AdminController::class, 'showEditUserPage']);

// post, put, delete routes
Route::post('/create_user', [AdminController::class, 'createUser']);
Route::put('/user/{user}', [AdminController::class, 'editUser']);
Route::delete('/user/{user}', [AdminController::class, 'deleteUser']);




