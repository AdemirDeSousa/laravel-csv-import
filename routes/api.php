<?php

use App\Http\Controllers\Api\V1\Clients\ClientController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {

    /**
     * Clients
     */
    Route::prefix('/clients')->controller(ClientController::class)->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
    });

});
