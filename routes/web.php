<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->middleware('auth');
// name('home'); 

Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/', [AuthController::class, 'home'])->name('register.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');

// maasuk kedalam halaman yang di tuju jadi harus menggunkan / yang ingin di tampilakan 
// kalo jarang pake agak lama buat running di laravel / ramnya kebesaran 
// name untuk membantu sebuah perubahan 
// guna auth singkatan authcation untuk membuat autahication atau mengidentiteskan 
// A dan C kapital karena dia huruf pertama sebagai perbedaan atau sambungan dari 2 kata  