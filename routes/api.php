<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;

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
