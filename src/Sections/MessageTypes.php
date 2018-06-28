<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\MessageType;

class MessageTypes extends AbstractSection
{
    /**
     * Index all message types.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null)
    {
        $url = sprintf('buckets/%d/categories.json', $this->bucket);

        $messageTypes = $this->client->get($url, [
            'query' => [
                'page' => $page,
            ],
        ]);

        return $this->indexResponse($messageTypes, MessageType::class);
    }

    /**
     * Get a message type.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $messageType = $this->client->get(
            sprintf('buckets/%d/categories/%d.json', $this->bucket, $id)
        );

        return new MessageType($this->response($messageType));
    }

    /**
     * Store a message type.
     *
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function store($data)
    {
        $message = $this->client->post(
            sprintf('buckets/%d/categories.json', $this->bucket),
            [
                'json' => $data,
            ]
        );

        return new MessageType($this->response($message));
    }

    /**
     * Update a message type.
     *
     * @param  int     $id
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, $data)
    {
        $message = $this->client->put(
            sprintf('buckets/%d/categories/%d.json', $this->bucket, $id),
            [
                'json' => $data,
            ]
        );

        return new MessageType($this->response($message));
    }

    /**
     * Destroy a message type.
     *
     * @param  int     $id
     * @return \Illuminate\Support\Collection
     */
    public function destroy($id)
    {
        return $this->client->delete(
            sprintf('buckets/%d/categories/%d.json', $this->bucket, $id)
        );
    }
}
