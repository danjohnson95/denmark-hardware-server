<?php

namespace App\Jobs;

use DanJohnson95\Pinout\Facades\PinService;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckNetwork
{
    use Dispatchable, SerializesModels;

    public function handle(): void
    {
	    $pin = PinService::pin(16);

        // Turn the pin off first so we get an indication
        // that the job is running.
        $pin->turnOff();

        $online = $this->isOnline();

        if ($online) {
            $pin->turnOn();
        } else {
            $pin->turnOff();
        }
    }

    private function isOnline(): bool
    {
        $connected = @fsockopen("1.1.1.1", 53, $errno, $errstr, 1);

        if ($connected) {
            fclose($connected);
            return true;
        }

        return false;
    }
}