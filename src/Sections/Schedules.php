<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Schedule;

class Schedules extends AbstractSection
{
    /**
     * Get a schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $schedule = $this->client->get(
            sprintf('buckets/%d/schedules/%d.json', $this->bucket, $id)
        );

        return new Schedule($this->response($schedule));
    }
}
