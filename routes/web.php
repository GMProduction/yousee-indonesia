<?php

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

Route::get('/', function () {
    return view('user.home');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});


Route::get('/admin/artikel', function () {
    return view('admin.artikel.artikel');
});

Route::get('/admin/tambah-artikel', function () {
    return view('admin.artikel.tambah_artikel');
});

Route::get('/admin/service', function () {
    return view('admin.service.service');
});

Route::get('/admin/tambah-service', function () {
    return view('admin.service.tambah_service');
});

Route::get('/admin/portfolio', function () {
    return view('admin.portfolio.portfolio');
});

Route::get('/admin/tambah-portfolio', function () {
    return view('admin.portfolio.tambah_portfolio');
});

Route::get('/admin/clients', function () {
    return view('admin.clients.clients');
});

Route::get('/admin/testimoni', function () {
    return view('admin.testimoni.testimoni');
});

Route::get('/admin/inbox', function () {
    return view('admin.inbox.inbox');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/admin/profile', function () {
    return view('admin.profile.profile');
});

Route::get('/admin/about', function () {
    return view('admin.about.about');
});
