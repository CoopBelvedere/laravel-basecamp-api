<?php

namespace Belvedere\Basecamp\Models\Traits;

use Basecamp;

trait Commentable
{
    /**
     * Get the comments.
     *
     * @return \Illuminate\Http\Collection
     */
    public function comments()
    {
        return Basecamp::comments($this->bucket->id, $this->id);
    }
}
