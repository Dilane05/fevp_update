<?php

namespace App\Consultations\Filters;

use App\Consultations\Filter;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use App\Consultations\TimeSlotGenerator;

class UnavailabilityFilter implements Filter
{
    public function __construct(Collection $unavilabilities)
    {
        $this->unavailabilities = $unavilabilities;
    }

    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
    {
        $interval->addFilter(function ($slot) use ($generator) {
            foreach ($this->unavailabilities as $unavailability) {
                if (
                    $slot->between(
                        $unavailability->schedule->date->setTimeFrom(
                            $unavailability->start_time->subMinutes(
                                $generator->consultation_type->duration - $generator->consultation_type->interval_between_sessions
                            )
                        ),
                        $unavailability->schedule->date->setTimeFrom(
                            $unavailability->end_time->subMinutes($generator->consultation_type->interval_between_sessions)
                        )
                    )
                ) {
                    return false;
                }
            }

            return true;
        });
    }
}
