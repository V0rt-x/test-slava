<?php

use App\Http\Controllers\ProductUploadController;
use Illuminate\Support\Facades\Route;

Route::prefix('/products/upload')->group(function () {
    Route::get('', [ProductUploadController::class, 'showForm']);
    Route::post('', [ProductUploadController::class, 'upload']);
});
