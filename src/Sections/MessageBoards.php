<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\MessageBoard;

class MessageBoards extends AbstractSection
{
    /**
     * Get a message board.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $messageBoard = $this->client->get(
            sprintf('buckets/%d/message_boards/%d.json', $this->bucket, $id)
        );

        return new MessageBoard($this->response($messageBoard));
    }
}
