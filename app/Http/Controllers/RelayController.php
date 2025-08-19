<?php

namespace App\Http\Controllers;

use DanJohnson95\Pinout\Facades\PinService;

class RelayController extends Controller
{
    public function __invoke(int $relayNumber, string $state)
    {
        // Relay 1 is on pin 26, Relay 2 is on pin 19, Relay 3 is on pin 6.
        $pin = match ($relayNumber) {
            1 => PinService::pin(26),
            2 => PinService::pin(19),
            3 => PinService::pin(6),
            default => abort(404, 'Relay not found'),
        };

        match ($state) {
            'on' => $pin->turnOn(),
            'off' => $pin->turnOff(),
            'toggle' => $pin->isOn() ? $pin->turnOff() : $pin->turnOn(),
            default => abort(400, 'Invalid state'),
        };

        return response()->json(['message' => "Relay {$relayNumber} is now {$state}"]);
    }
}
