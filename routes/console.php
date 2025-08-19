<?php

use App\Jobs\CheckNetwork;
use App\Jobs\CheckNgrok;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new CheckNetwork)->everySecond();
Schedule::job(new CheckNgrok)->everySecond();