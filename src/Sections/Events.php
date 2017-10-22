<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Event;

class Events extends AbstractSection
{
    /**
     * Index all events.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/recordings/%d/events.json', $this->bucket, $this->parent);

        $events = $this->client->get($url);

        return $this->indexResponse($events, Event::class);
    }
}
