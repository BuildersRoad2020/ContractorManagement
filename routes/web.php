<?php

use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Route;
URL::forceScheme('https');
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
    if(Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified', 'changedefaultpassword'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified',])->get('/testing', function () {
    return view('test');
})->name('test');

Route::middleware(['auth:sanctum', 'verified', 'changedefaultpassword'])->get('/contractors', function () {
    return view('contractors');
})->name('contractors');

Route::middleware(['auth:sanctum', 'verified', 'changedefaultpassword'])->get('/contractors/documents-review', function () {
    return view('documents-review');
})->name('documents-review');

Route::middleware(['auth:sanctum', 'verified', 'changedefaultpassword'])->get('/technicians', function () {
    return view('technicians');
})->name('technicians');

Route::middleware(['auth:sanctum', 'verified', 'changedefaultpassword' ])->get('/users', function () {
    return view('users');
})->name('users');

Route::middleware(['auth:sanctum', 'verified', 'changedefaultpassword'])->get('/admin/settings', function () {
    return view('settings');
})->name('settings');

Route::middleware(['auth:sanctum', 'verified', 'changedefaultpassword'])->get('/forms', function () {
    return view('forms');
})->name('forms');

Route::middleware(['auth:sanctum', 'verified', ])->get('/passwordchange/firstlogin', function () {
    return view('passwordchange');
})->name('passwordchange');