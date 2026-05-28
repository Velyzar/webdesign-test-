<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;
use App\Http\Controllers\Api\Blog\Admin\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::group(['prefix' => 'blog'], function () {
    Route::apiResource('posts', PostController::class)->names('blog.posts');
});

// Адмінка
Route::group(['prefix' => 'admin/blog'], function () {
    $methods = ['index', 'store', 'update'];
    Route::apiResource('categories', \App\Http\Controllers\Api\Blog\Admin\CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');
});

Route::group(['prefix' => 'blog'], function () {
    Route::resource('categories', CategoryController::class)
        ->only(['index', 'store', 'update', 'show']);
});
