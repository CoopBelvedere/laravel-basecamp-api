<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Schedule extends AbstractModel
{
    /**
     * Get the schedule.
     *
     * @return \Illuminate\Http\Collection
     */
    public function show()
    {
        return Basecamp::schedules($this->bucket->id)->show($this->id);
    }

    /**
     * List the schedule entries.
     *
     * @return \Illuminate\Http\Collection
     */
    public function entries()
    {
        return Basecamp::scheduleEntries($this->bucket->id, $this->id);
    }
}
