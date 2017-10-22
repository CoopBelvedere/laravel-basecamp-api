<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Inbox;

class Inboxes extends AbstractSection
{
    /**
     * Get an inbox.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $inbox = $this->client->get(
            sprintf('buckets/%d/inboxes/%d.json', $this->bucket, $id)
        );

        return new Inbox($this->response($inbox));
    }
}
