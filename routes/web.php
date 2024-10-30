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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('data')->group(
    function () {
        Route::get('province', [\App\Http\Controllers\ProvinceController::class, 'province']);
        Route::get('province/{id}/city', [\App\Http\Controllers\ProvinceController::class, 'city']);
        Route::get('city', [\App\Http\Controllers\ProvinceController::class, 'cityAll']);
        Route::get('type', [\App\Http\Controllers\ItemController::class, 'getType']);
        Route::prefix('item')->group(
            function () {
                Route::get('datatable', [\App\Http\Controllers\ItemController::class, 'datatable']);
                Route::get('card', [\App\Http\Controllers\ItemController::class, 'cardItem']);
                Route::post('delete/{id}', [\App\Http\Controllers\ItemController::class, 'delete']);
                Route::post('post-item', [\App\Http\Controllers\ItemController::class, 'postItem']);
                Route::get('url-street-view/{id}', [\App\Http\Controllers\ItemController::class, 'getUrlStreetView']);
                Route::get('by-id/{id}', [\App\Http\Controllers\ItemController::class, 'getItemByID']);
                Route::post('show-data', [\App\Http\Controllers\ItemController::class, 'changeShowLandingPage']);
                Route::get('generate-slug', [\App\Http\Controllers\ItemController::class, 'generateSlug']);
            }
        );
    }
);

Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('titik', [\App\Http\Controllers\Admin\DashboardController::class, 'getDataTitik'])->name('admin.dashboard.titik');
    Route::get('titik-public', [\App\Http\Controllers\Admin\DashboardController::class, 'getDataTitikPublic'])->name('admin.dashboard.titik.public');
    Route::get('article', [\App\Http\Controllers\Admin\DashboardController::class, 'getDataArticle'])->name('admin.dashboard.article');
    Route::get('dashboard-portfolio', [\App\Http\Controllers\Admin\DashboardController::class, 'getDataPortofolio'])->name('admin.dashboard.portfolio');

    Route::prefix('inbox')->group(function () {
        Route::get('datatable', [\App\Http\Controllers\Admin\InboxController::class, 'datatable'])->name('admin.dashboard.inbox.datatable');
        Route::post('delete', [\App\Http\Controllers\Admin\InboxController::class, 'delete'])->name('admin.dashboard.inbox.delete');
        Route::get('notif', [\App\Http\Controllers\Admin\InboxController::class, 'getInbox'])->name('admin.dashboard.inbox.notif');
        Route::get('find/{id}', [\App\Http\Controllers\Admin\InboxController::class, 'findInbox'])->name('admin.dashboard.inbox.findInbox');
    });

    Route::prefix('tags')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\TagsController::class, 'getAll'])->name('admin.tags');
        Route::post('add', [\App\Http\Controllers\Admin\TagsController::class, 'postTag'])->name('admin.tags.add');
    });
    Route::match(['GET', 'POST'], 'profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
    Route::prefix('artikel')->group(function () {
        Route::get('datatable', [\App\Http\Controllers\Admin\ArticleController::class, 'datatable'])->name('admin.article.datatable');
        Route::get('', [\App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin.article');
        Route::match(['GET', 'POST'], 'data', [\App\Http\Controllers\Admin\ArticleController::class, 'pageAdd'])->name('admin.article.data');
        Route::post('delete', [\App\Http\Controllers\Admin\ArticleController::class, 'delete'])->name('admin.article.delete');
    });
    Route::prefix('service')->group(function () {
        Route::get('datatable', [\App\Http\Controllers\Admin\ServiceController::class, 'datatable'])->name('admin.service.datatable');
        Route::get('', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('admin.service');
        Route::match(['GET', 'POST'], 'data', [\App\Http\Controllers\Admin\ServiceController::class, 'pageAdd'])->name('admin.service.data');
        Route::post('delete', [\App\Http\Controllers\Admin\ServiceController::class, 'delete'])->name('admin.service.delete');
    });

    Route::prefix('portfolio')->group(function () {
        Route::get('datatable', [\App\Http\Controllers\Admin\PortofolioController::class, 'datatable'])->name('admin.portfolio.datatable');
        Route::get('', [\App\Http\Controllers\Admin\PortofolioController::class, 'index'])->name('admin.portfolio');
        Route::match(['GET', 'POST'], 'data', [\App\Http\Controllers\Admin\PortofolioController::class, 'pageAdd'])->name('admin.portfolio.data');
        Route::post('delete', [\App\Http\Controllers\Admin\PortofolioController::class, 'delete'])->name('admin.portfolio.delete');
    });

    Route::prefix('clients')->group(function () {
        Route::get('datatable', [\App\Http\Controllers\Admin\ClientController::class, 'datatable'])->name('admin.clients.datatable');
        Route::get('', [\App\Http\Controllers\Admin\ClientController::class, 'index'])->name('admin.clients');
        Route::post('data', [\App\Http\Controllers\Admin\ClientController::class, 'pageAdd'])->name('admin.clients.data');
        Route::post('delete', [\App\Http\Controllers\Admin\ClientController::class, 'delete'])->name('admin.clients.delete');
    });
    Route::match(['GET', 'POST'], 'about', [\App\Http\Controllers\Admin\AboutController::class, 'index'])->name('admin.about');
    Route::prefix('testimoni')->group(function () {
        Route::get('datatable', [\App\Http\Controllers\Admin\TestimoniController::class, 'datatable'])->name('admin.testimoni.datatable');
        Route::get('', [\App\Http\Controllers\Admin\TestimoniController::class, 'index'])->name('admin.testimoni');
        Route::post('data', [\App\Http\Controllers\Admin\TestimoniController::class, 'pageAdd'])->name('admin.testimoni.data');
        Route::post('delete', [\App\Http\Controllers\Admin\TestimoniController::class, 'delete'])->name('admin.testimoni.delete');
    });
    Route::get('inbox', function () {
        return view('admin.inbox.inbox');
    });
});


Route::match(['GET', 'POST'], '/login', [\App\Http\Controllers\Admin\LoginController::class, 'index'])->name('login');
Route::get('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout']);


Route::prefix('artikel')->group(function () {
    Route::get('', [\App\Http\Controllers\ArtikelController::class, 'index']);
    Route::get('{slug}', [\App\Http\Controllers\ArtikelController::class, 'detail'])->name('article.detail');
    Route::get('tag/{tag}', [\App\Http\Controllers\ArtikelController::class, 'byTag'])->name('article.tag');
});

Route::get('/services', [\App\Http\Controllers\ServiceController::class, 'index']);


Route::get('/titik/{province}', [\App\Http\Controllers\TitikController::class, 'titikProvince']);
Route::get('/titik-kota/{city}', [\App\Http\Controllers\TitikController::class, 'titikCity']);

Route::get('/titik/{prvince}/{city}', function () {
    return view('user.titik_per_kota');
});

Route::get('/titik-kami', [\App\Http\Controllers\TitikController::class, 'index']);
Route::match(['POST', 'GET'], '/contact', [\App\Http\Controllers\ContactController::class, 'index']);

Route::get('/portfolio', [\App\Http\Controllers\PortfolioController::class, 'index']);
Route::get('/detailtitik/{slug}', [\App\Http\Controllers\TitikController::class, 'detail']);

Route::get('/map/data', [\App\Http\Controllers\MapController::class, 'get_map_json']);
Route::get('/map/data/{id}', [\App\Http\Controllers\MapController::class, 'get_map_by_id']);

Route::get('/cek-map', [\App\Http\Controllers\MapController::class, 'index']);
Route::get('/cek-map/data', [\App\Http\Controllers\MapController::class, 'get_map_json']);
Route::get('/cek-map/data-detail/{id}', [\App\Http\Controllers\MapController::class, 'get_map_by_id']);
