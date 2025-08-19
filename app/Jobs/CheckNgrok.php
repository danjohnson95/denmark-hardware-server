<?php

namespace App\Jobs;

use DanJohnson95\Pinout\Facades\PinService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckNgrok implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pin = PinService::pin(20);
        $pin->turnOff();

        $response = @file_get_contents("http://127.0.0.1:4040/api/tunnels");

        if ($response === false) {
            $pin->turnOff();            
        } else {
            $data = json_decode($response, true);
            if (!empty($data['tunnels'])) {
                $pin->turnOn();
            } else {
                $pin->turnOff();
            }
        }
    }
}
