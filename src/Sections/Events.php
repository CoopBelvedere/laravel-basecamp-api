<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Event;

class Events extends AbstractSection
{
    /**
     * Index all events.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null)
    {
        $url = sprintf('buckets/%d/recordings/%d/events.json', $this->bucket, $this->parent);

        $events = $this->client->get($url, [
            'query' => [
                'page' => $page,
            ],
        ]);

        return $this->indexResponse($events, Event::class);
    }
}
