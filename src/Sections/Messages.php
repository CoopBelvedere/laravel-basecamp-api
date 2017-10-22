<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Message;
use Belvedere\Basecamp\Sections\Traits\Recording;

class Messages extends AbstractSection
{
    use Recording;

    /**
     * Index all messages.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/message_boards/%d/messages.json', $this->bucket, $this->parent);

        $messages = $this->client->get($url);

        return $this->indexResponse($messages, Message::class);
    }

    /**
     * Get a message board.
     *
     * @param  int  $bucket
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $message = $this->client->get(
            sprintf('buckets/%d/messages/%d.json', $this->bucket, $id)
        );

        return new Message($this->response($message));
    }

    /**
     * Store a message.
     *
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function store($data)
    {
        $message = $this->client->post(
            sprintf('buckets/%d/message_boards/%d/messages.json', $this->bucket, $this->parent),
            [
                'json' => $data,
            ]
        );

        return new Message($this->response($message));
    }

    /**
     * Update a message.
     *
     * @param  int     $id
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, $data)
    {
        $message = $this->client->put(
            sprintf('buckets/%d/messages/%d.json', $this->bucket, $id),
            [
                'json' => $data,
            ]
        );

        return new Message($this->response($message));
    }
}
