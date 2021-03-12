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
    
    /**
     * Get subscription
     *
     * @param int $id
     * @return string
     * @throws GuzzleException
     */
    public function getSubscription(int $id): string
    {
        $recordings = $this->client->get(sprintf('buckets/%d/recordings/%d/subscription.json', $this->bucket, $id));

        return $this->response($recordings);
    }

    /**
     * Update subscription
     *
     * @param int $id
     * @param int $unsubscriptions_id unsubscribers for the recording
     * @param int $subscriptions subscribers for the recording
     * @return string
     * @throws GuzzleException
     */
    public function updateSubscriptions(int $id, int $unsubscriptions_id = null, int $subscriptions = null): string
    {
        $param = [
            'query' => [
                'unsubscriptions' => $unsubscriptions_id,
                'subscriptions' => $subscriptions
            ]
        ];
        $recordings = $this->client->put(sprintf('buckets/%d/recordings/%d/subscription.json', $this->bucket, $id), $param);

        return $this->indexResponse($recordings, Recording::class);
    }
}
