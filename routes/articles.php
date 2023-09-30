<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\ArticleController;
use Illuminate\Support\Facades\Route;


Route::group([
    'namespace' => '\App\Http\Controllers\Api\v1',
    'prefix' => '/v1',
], function () {
    Route::resource('articles', ArticleController::class)->only('index');
});
