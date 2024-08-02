<?php

namespace App\Consultations;

use Carbon\CarbonPeriod;
use App\Consultations\TimeSlotGenerator;

interface Filter
{
    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval);
}
