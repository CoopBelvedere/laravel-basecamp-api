<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class TodoListGroup extends TodoList
{
    /**
     * Reposition the to-do list group.
     *
     * @param  int  $position
     * @return string
     */
    public function reposition($position)
    {
        return Basecamp::todoListGroups($this->bucket->id)
                       ->reposition($this->id, $position);
    }
}
