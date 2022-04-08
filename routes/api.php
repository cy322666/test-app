<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

            Route::get('/{product:uuid}', 'get');

            Route::put('/{product:uuid}', 'update');

            Route::delete('/{product:uuid}', 'delete');
        });
    });

    Route::controller(CategoryController::class)->group(function () {

        Route::prefix('categories')->group(function () {

            Route::post('/', 'create');

            Route::get('/', 'list');

            Route::get('/{category:uuid}', 'get');

            Route::put('/{category:uuid}', 'update');

            Route::delete('/{category:uuid}', 'delete');
        });
    });
});
