<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\ClientReply;

class ClientReplies extends AbstractSection
{
    /**
     * Index all client replies.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null)
    {
        $url = sprintf('buckets/%d/client/recordings/%d/replies.json', $this->bucket, $this->parent);

        $replies = $this->client->get($url, [
            'page' => $page,
        ]);

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
