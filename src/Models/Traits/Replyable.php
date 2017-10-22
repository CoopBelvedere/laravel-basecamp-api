<?php

namespace Belvedere\Basecamp\Models\Traits;

use Basecamp;

trait Replyable
{
    /**
     * Get the recording replies.
     *
     * @return \Illuminate\Http\Collection
     */
    public function replies()
    {
        return Basecamp::clientReplies()->index($this->bucket->id, $this->id);
    }
}
