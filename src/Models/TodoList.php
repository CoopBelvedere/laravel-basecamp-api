<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;
use Belvedere\Basecamp\Models\Traits\Commentable;

class TodoList extends Recording
{
    use Commentable;

    /**
     * List the to-dos.
     *
     * @return \Illuminate\Http\Collection
     */
    public function todos()
    {
        return Basecamp::todos($this->bucket->id, $this->id);
    }

    /**
     * Update the todo list.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Collection
     */
    public function update(array $data)
    {
        $todolist = Basecamp::todoLists($this->bucket->id)
                            ->update($this->id, $data);

        $this->setAttributes($todolist);

        return $todolist;
    }
}
