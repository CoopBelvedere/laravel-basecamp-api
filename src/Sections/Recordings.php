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
     * @param  int     $page
     * @return \Illuminate\Support\Collection
     */
    public function index($type, array $parameters = array(), $page = null)
    {
        $url = 'projects/recordings.json';

        $recordings = $this->client->get($url, [
            'query' => array_merge([
                'type' => $type,
                'page' => $page,
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
    
    /**
     * Archive a recording.
     *
     * @param int $id
     * @return string
     */
    public function archive(int $id)
    {
        return $this->client->put(
            sprintf('buckets/%d/recordings/%d/status/archived.json', $this->bucket, $id)
        );
    }
   
    /**
     * Unarchive a recording.
     *
     * @param int $id
     * @return string
     */
    public function unarchive(int $id)
    {
        return $this->client->put(
            sprintf('buckets/%d/recordings/%d/status/active.json', $this->bucket, $id)
        );
    }
}
