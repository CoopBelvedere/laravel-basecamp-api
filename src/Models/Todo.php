<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;
use Belvedere\Basecamp\Models\Traits\Commentable;

class Todo extends Recording
{
    use Commentable;

    /**
     * Update the to-do.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Collection
     */
    public function update(array $data)
    {
        $todo = Basecamp::todos($this->bucket->id)->update($this->id, $data);

        $this->setAttributes($todo);

        return $todo;
    }

    /**
     * Complete the to-do.
     *
     * @return string
     */
    public function complete()
    {
        return Basecamp::todos($this->bucket->id)->complete($this->id);
    }

    /**
     * Uncomplete the to-do.
     *
     * @return string
     */
    public function uncomplete()
    {
        return Basecamp::todos($this->bucket->id)->uncomplete($this->id);
    }

    /**
     * Reposition the to-do.
     *
     * @param  int  $position
     * @return string
     */
    public function reposition($position)
    {
        return Basecamp::todos($this->bucket->id)
                       ->reposition($this->id, $position);
    }
}
