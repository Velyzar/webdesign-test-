<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;
use App\Http\Controllers\Api\Blog\Admin\CategoryController;
use App\Http\Controllers\Api\Blog\Admin\PostController as AdminPostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Публічна частина блогу (гість)
Route::group(['prefix' => 'blog'], function () {
    Route::apiResource('posts', PostController::class)->names('blog.posts');

    Route::resource('categories', CategoryController::class)
        ->only(['index', 'store', 'update', 'show']);
});

// Адмінка блогу (те, що нам потрібно для Лаб 8)
Route::group(['prefix' => 'admin/blog'], function () {
    $methods = ['index', 'store', 'update'];

    // Категорії в адмінці
    Route::apiResource('categories', CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');

    // ЛАБОРАТОРНА 8: Реєстрація адмінських постів
    Route::apiResource('posts', AdminPostController::class)
        ->except(['show'])
        ->names('blog.admin.posts');
});

Route::prefix('digging_deeper')->group(function () {
    Route::get('process-video', [\App\Http\Controllers\DiggingDeeperController::class, 'processVideo'])
        ->name('digging_deeper.processVideo');

    Route::get('prepare-catalog', [\App\Http\Controllers\DiggingDeeperController::class, 'prepareCatalog'])
        ->name('digging_deeper.prepareCatalog');
    Route::get('/blog/posts/{id}', [\App\Http\Controllers\Api\Blog\PostController::class, 'show']);


});

