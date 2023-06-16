<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DonorSearchController;
use App\Http\Controllers\HomeController;
use TCG\Voyager\Facades\Voyager;
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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
});

// Route::get('/register', function () {
//     return view('register');
// });

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@create')->name('register');


Auth::routes();

Route::get('/blood-donation-process', function () {
    return view('donner');
});

// Route::get('/search', function () {
//     return view('search');
// });


// Route::get('/search', [DonorSearchController::class, 'search'])->name('search');

Route::prefix('/donors')->group(function () {
    Route::get('', [DonorSearchController::class, 'index'])->name('donorsPage');
    Route::post('/search', [DonorSearchController::class, 'search'])->name('donorsSearch');
});

// route for posts
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

// route for single post
Route::get('/{slug}', [HomeController::class, 'single_post'])->name('single_post');

// route for donner sang
Route::get('/donner/donner_sang', [HomeController::class, 'donner_sang'])->name('donner_sang');

// route for save le  donner du sang
Route::post('/donner/save_donneur_du_sang', [HomeController::class, 'save_donneur_du_sang'])->name('save_donneur_du_sang');


Route::post('/contact', [HomeController::class, 'store'])->name('contact');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
