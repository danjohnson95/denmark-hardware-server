<?php

namespace App\Http\Controllers;

use DanJohnson95\Pinout\Facades\PinService;

class RelayController extends Controller
{
    public function __invoke(int $relayNumber, string $state)
    {
        dump("Relay {$relayNumber} set to {$state}");

        // Relay 1 is on pin 26, Relay 2 is on pin 19
        $pin = match ($relayNumber) {
            1 => PinService::pin(26),
            2 => PinService::pin(19),
            default => abort(404, 'Relay not found'),
        };

        match ($state) {
            'on' => $pin->turnOn(),
            'off' => $pin->turnOff(),
            'toggle' => $pin->isOn() ? $pin->turnOff() : $pin->turnOn(),
            default => abort(400, 'Invalid state'),
        };
    }
}
