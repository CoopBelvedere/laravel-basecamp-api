<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Inbox extends AbstractModel
{
    /**
     * Get the inbox.
     *
     * @return \Illuminate\Http\Collection
     */
    public function show()
    {
        return Basecamp::inboxes($this->bucket->id)->show($this->id);
    }

    /**
     * Get the inbox forwards.
     *
     * @return \Illuminate\Http\Collection
     */
    public function forwards()
    {
        return Basecamp::forwards($this->bucket->id, $this->id);
    }
}
