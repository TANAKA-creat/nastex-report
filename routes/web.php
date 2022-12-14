<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;


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
//     return view('welcome');
// });

Route::get('/', [ReportController::class, 'index'])->name('reports.index');

Route::controller(UserController::class)->group(function(){
    Route::get('users/mypage','mypage')->name('mypage');
    Route::get('users/mypage/edit','edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit','edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password','update_password')->name('mypage.update_password');
});

//投稿フォームページ
// Route::group(['middleware' => 'auth'], function() {
//     Route::get('/reports', [ReportController::class,'create'])->name('reports.create');
//     Route::post('/reports', [ReportController::class,'create']);
//  });

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::resource('reports', ReportController::class)->middleware(['auth', 'verified']);
// Route::resource('photos', PhotoController::class)->middleware(['auth','verified']);

Route::get('photos/', [PhotoController::class, 'index'])->middleware(['auth', 'verified'])->name('photos.index');
Route::post('/photos/store', [PhotoController::class, 'store'])->name('photos.store');
Route::get('photos/{photo}/', [PhotoController::class,'show'])->name('photos.show');


Route::delete('/photos/{photo}/destroy', [PhotoController::class,'destroy'])->name('photos.destroy');
    


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');