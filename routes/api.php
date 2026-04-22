<?php

use App\Http\Controllers\DatabaseExportController;
use Illuminate\Support\Facades\Route;

Route::get('/export/database', [DatabaseExportController::class, 'index'])
    ->name('api.export.database');
