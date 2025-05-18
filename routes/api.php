<?php
declare(strict_types=1);

use App\Http\Controllers\PersonsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/persons')->group(function () {
    Route::get('/byDate', [PersonsController::class, 'listByDate']);
});
