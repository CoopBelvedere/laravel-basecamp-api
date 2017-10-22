<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\ClientReply;

class ClientReplies extends AbstractSection
{
    /**
     * Index all client replies.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/client/recordings/%d/replies.json', $this->bucket, $this->parent);

        $replies = $this->client->get($url);

        return $this->indexResponse($replies, ClientReply::class);
    }

    /**
     * Get a client reply.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $reply = $this->client->get(
            sprintf('buckets/%d/client/recordings/%d/replies/%d.json', $this->bucket, $this->parent, $id)
        );

        return new ClientReply($this->response($reply));
    }
}
