<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\ScheduleEntry;

class ScheduleEntries extends AbstractSection
{
    /**
     * Index all the schedule entries.
     *
     * @param  int     $page
     * @param  string  $status
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null, $status = null)
    {
        $url = sprintf('buckets/%d/schedules/%d/entries.json', $this->bucket, $this->parent);

        $entries = $this->client->get($url, [
            'query' => [
                'page' => $page,
            ],
        ]);

        return $this->indexResponse($entries, ScheduleEntry::class);
    }

    /**
     * Index archived schedule entries.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function archived($page = null)
    {
        return $this->index($page, 'archived');
    }

    /**
     * Index trashed schedule entries.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function trashed($page = null)
    {
        return $this->index($page, 'trashed');
    }

    /**
     * Get a schedule entry.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $entry = $this->client->get(
            sprintf('buckets/%d/schedule_entries/%d.json', $this->bucket, $id)
        );

        return new ScheduleEntry($this->response($entry));
    }

    /**
     * Store a schedule entry.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function store(array $data)
    {
        $entry = $this->client->post(
            sprintf('buckets/%d/schedules/%d/entries.json', $this->bucket, $this->parent),
            [
                'json' => $data,
            ]
        );

        return new ScheduleEntry($this->response($entry));
    }

    /**
     * Update a schedule entry.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, array $data)
    {
        $entry = $this->client->put(
            sprintf('buckets/%d/schedule_entries/%d.json', $this->bucket, $id),
            [
                'json' => $data,
            ]
        );

        return new ScheduleEntry($this->response($entry));
    }
}
