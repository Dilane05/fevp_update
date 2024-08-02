<?php

namespace App\Consultations;

use App\Models\ConsultationType;
use App\Models\Schedule;
use Carbon\CarbonInterval;

class TimeSlotGenerator
{
    public const INCREMENT = 30;

    public $schedule;

    public $consultation_type;

    protected $interval;

    public function __construct(Schedule $schedule, ConsultationType $consultation_type)
    {
        $this->schedule = $schedule;
        $this->consultation_type = $consultation_type;

        $this->interval = CarbonInterval::minutes($schedule->interval_between_sessions)
            ->toPeriod(
                $schedule->date->setTimeFrom($schedule->start_time),
                $schedule->date->setTimeFrom(
                    $schedule->end_time->subMinutes($consultation_type->duration)
                )
            );
    }

    public function applyFilters(array $filters)
    {
        foreach ($filters as $filter) {
            if (!$filter instanceof Filter) {
                continue;
            }

            $filter->apply($this, $this->interval);
        }

        return $this;
    }

    public function get()
    {
        return $this->interval;
    }
}
