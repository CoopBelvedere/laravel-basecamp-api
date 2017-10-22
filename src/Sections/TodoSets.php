<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\TodoSet;

class TodoSets extends AbstractSection
{
    /**
     * Get a todo list.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $todolist = $this->client->get(
            sprintf('buckets/%d/todosets/%d.json', $this->bucket, $id)
        );

        return new TodoSet($this->response($todolist));
    }
}
