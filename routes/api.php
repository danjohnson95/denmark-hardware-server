<?php

use App\Http\Controllers\RelayController;
use Illuminate\Support\Facades\Route;

Route::post('/relay/{relayId}/{state}', RelayController::class);
