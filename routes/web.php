<?php
declare(strict_types=1);

use App\Http\Controllers\PersonFileUploadController;
use Illuminate\Support\Facades\Route;

Route::prefix('/persons')->group(function () {
    Route::prefix('/upload')->group(function () {
        Route::get('', [PersonFileUploadController::class, 'showForm']);
        Route::post('', [PersonFileUploadController::class, 'upload']);
    });
});
