<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([AuthMiddleware::class])->group(function () {

    Route::controller(ProductController::class)->group(function () {

        Route::prefix('products')->group(function () {

            Route::get('/', 'list');

            Route::post('/', 'create');

            Route::get('/{product:id}', 'get');

            Route::put('/{product:id}', 'update');

            Route::delete('/{product:id}', 'delete');
        });
    });

    Route::controller(CategoryController::class)->group(function () {

        Route::prefix('categories')->group(function () {

            Route::post('/', 'create');

            Route::get('/', 'list');

            Route::get('/{category:id}', 'get');

            Route::put('/{category:id}', 'update');

            Route::delete('/{category:id}', 'delete');
        });
    });
});
