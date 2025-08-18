<?php

use App\Jobs\CheckNetwork;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new CheckNetwork)->everySecond();