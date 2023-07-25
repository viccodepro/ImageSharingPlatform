<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//This is for the get event of the index page
// Route::get('/', array('as' => 'index_page', 'uses' => 'ImageController@getIndex'));

Route::get('/', [App\Http\Controllers\ImageController::class, 'getIndex'])->name('index_page');
//This is for the post event of the index.page
// Route::post('/', array('as' => 'index_page_post', 'before' => 'csrf', 'uses' => 'ImageController@postIndex'));

Route::post('/', [\App\Http\Controllers\ImageController::class, 'postIndex'])->name('index_page_by_post');
Route::get('snatch/{id}', [\App\Http\Controllers\ImageController::class, 'getSnatch'])->name('get_image_information')->where('id', '[0-9]+');
Route::get('all_images', [\App\Http\Controllers\ImageController::class, 'getAll'])->name('all_images');
Route::get('delete/{id}', [\App\Http\Controllers\ImageController::class, 'getDelete'])->name('delete_image')->where('id', '[0-9]+');
