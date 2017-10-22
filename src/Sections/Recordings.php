<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Recording;

class Recordings extends AbstractSection
{
    /**
     * Index all recordings.
     *
     * @param  string  $type
     * @param  array   $parameters
     * @return \Illuminate\Support\Collection
     */
    public function index($type, array $parameters = array(), $nextPage = null)
    {
        $url = $nextPage ?: 'projects/recordings.json';

        $recordings = $this->client->get($url, [
            'query' => array_merge([
                'type' => $type,
            ], $parameters)
        ]);

        return $this->indexResponse($recordings, Recording::class);
    }

    /**
     * Trash a recording.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        return $this->client->put(
            sprintf('buckets/%d/recordings/%d/status/trashed.json', $this->bucket, $id)
        );
    }
}
