<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{UserController, ArticleController};
use App\Http\Controllers\Admin\Ajax\{ArticleCommentController};
use App\Http\Controllers\Admin\Ajax\ArticleController as AjaxArticleController;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'HomeController@index');

    Route::group(['namespace' => 'Admin'], function () {
        Route::resource('users', UserController::class);
        Route::resource('articles', ArticleController::class)->name('index', 'admin.articles.index');
    });

    Route::group(['namespace' => 'Admin\Ajax', 'prefix' => 'ajax'], function () {
        Route::post('articles/{article}/comments', [ArticleCommentController::class, 'store'])->name('comments.store');
        Route::get('articles/{article}/comments', [ArticleCommentController::class, 'index'])->name('comments.index');
        Route::post('articles/{article}/publish', [AjaxArticleController::class, 'publish'])->name('articles.publish');
        Route::get('articles', [AjaxArticleController::class, 'search'])->name('articles.search');
    });
});



Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Auth'], function () {

    Route::get('login', function () {
        return view('auth.login');
    })->name('login');
    Route::get('register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
