<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();
Route::get('/', HomeController::class)->name('home');

// user
Route::group(['middleware' => ['auth']], function () {

	Route::group(['prefix' => 'users', 'middleware' => ['role:admin'], 'controller' => UserController::class], function () {
		Route::get('/', 'index')->name('users.index')->middleware('can:users.index');
		Route::get('/create', 'create')->name('users.create')->middleware('can:users.create');
		Route::post('/store', 'store')->name('users.store')->middleware('can:users.store');
		Route::get('/{user}', 'edit')->name('users.edit')->middleware('can:users.edit');
		Route::put('/{user}', 'update')->name('users.update')->middleware('can:users.update');
		Route::delete('/{user}', 'destroy')->name('users.destroy')->middleware('can:users.destroy');
	});
	// Books
	Route::group(['prefix' => 'books', 'controller' => BookController::class], function () {
		Route::get('/', 'index')->name('books.index')->middleware('can:books.index');
		Route::get('/create', 'create')->name('books.create')->middleware('can:books.create');
		Route::post('/store', 'store')->name('books.store')->middleware('can:books.store');
		Route::get('/{book}', 'edit')->name('books.edit')->middleware('can:books.edit');
		Route::put('/{book}', 'update')->name('books.update')->middleware('can:books.update');
		Route::delete('/{book}', 'destroy')->name('books.destroy')->middleware('can:books.destroy');
	});

	// categories
	Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
		Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
		Route::get('/create', 'create')->name('categories.create')->middleware('can:categories.create');
		Route::post('/store', 'store')->name('categories.store')->middleware('can:categories.store');
		Route::get('/{category}', 'edit')->name('categories.edit')->middleware('can:categories.edit');
		Route::put('/{category}', 'update')->name('categories.update')->middleware('can:categories.update');
		Route::delete('/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
	});

	// Author
	Route::group(['prefix' => 'authors', 'controller' => AuthorController::class], function () {
		Route::get('/', 'index')->name('authors.index')->middleware('can:authors.index');
		Route::get('/create', 'create')->name('authors.create')->middleware('can:authors.create');
		Route::post('/store', 'store')->name('authors.store')->middleware('can:authors.store');
		Route::get('/{author}', 'edit')->name('authors.edit')->middleware('can:authors.edit');
		Route::put('/{author}', 'update')->name('authors.update')->middleware('can:authors.update');
		Route::delete('/{author}', 'destroy')->name('authors.destroy')->middleware('can:authors.destroy');
	});
});
