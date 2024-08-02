<?php

namespace App\Consultations\Filters;

use App\Consultations\Filter;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use App\Consultations\TimeSlotGenerator;

class ConsultationFilter implements Filter
{
    public $consultations;

    public function __construct(Collection $consultations)
    {
        $this->consultations = $consultations;
    }

    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
    {
        $interval->addFilter(function ($slot) use ($generator) {
            foreach ($this->consultations as $consultation) {
                if (
                    $slot->between(
                        $consultation->date->setTimeFrom(
                            $consultation->start_time->subMinutes($generator->consultation_type->duration)
                        ),
                        $consultation->date->setTimeFrom(
                            $consultation->end_time
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
