<?php

use App\Http\Controllers\Api\V1\Clients\ClientController;
use App\Http\Controllers\Api\V1\Freight\FreightController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {

    /**
     * Clients
     */
    Route::prefix('/clients')->controller(ClientController::class)->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
    });

    /**
     * Freights
     */
    Route::prefix('/freights')->controller(FreightController::class)->group(function () {
        Route::get('/{clientId}', 'index');
        Route::post('/import', 'import');
    });

});
