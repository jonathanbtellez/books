<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthUserApiController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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




Route::post('/login', [AuthUserApiController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);


Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::post('/logout', [AuthUserApiController::class, 'logout']);
	Route::get('/profile', [AuthUserApiController::class, 'profile']);

	Route::group(['prefix' => 'users', 'controller' => UserController::class], function () {
		Route::get('/', 'index');
		Route::post('/', 'store');
		Route::get('/{user}', 'show');
		Route::put('/{user}', 'update');
		Route::delete('/{user}', 'destroy');
	});

	Route::group(['prefix' => 'books', 'controller' => BookController::class], function () {
		Route::get('/', 'index');
		Route::post('/', 'store');
		Route::get('/{book}', 'show');
		Route::put('/{book}', 'update');
		Route::delete('/{book}', 'destroy');
	});

	Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
		Route::get('/', 'index');
		Route::post('/', 'store');
		Route::get('/{category}', 'show');
		Route::put('/{category}', 'update');
		Route::delete('/{category}', 'destroy');
	});

	Route::group(['prefix' => 'authors', 'controller' => AuthorController::class], function () {
		Route::get('/', 'index');
		Route::post('/', 'store');
		Route::get('/{author}', 'show');
		Route::put('/{author}', 'update');
		Route::delete('/{author}', 'destroy');
	});
});
