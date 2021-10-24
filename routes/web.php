<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

//Route::get('/add_character', function () {
//    return view('addCharacter');
//});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//normal user routes
Route::get('/characters', [CharacterController::class,'index']);
Route::get('/profile/{username}', [UserController::class,'index']);
Route::put('/profile/{username}',[UserController::class,'profileUpdate']);
Route::get('/characters/{id}', [CharacterController::class, 'characterPage']);
Route::post('/character/favorite',[CharacterController::class, 'favorite'])->name('favorite');
Route::post('/character/unfavorite',[CharacterController::class, 'unfavorite'])->name('unfavorite');


//admin routes
Route::get('/overview', [CharacterController::class,'overview']);
Route::get('/add-character',[CharacterController::class,'create']);
Route::post('/add-character',[CharacterController::class,'store']);
Route::get('/details/{id}', [CharacterController::class, 'read']);
Route::get('/edit-character/{id}', [CharacterController::class, 'edit']);
Route::put('/update-character/{id}', [CharacterController::class, 'update']);
Route::get('/delete-character/{id}', [CharacterController::class, 'destroy']);
