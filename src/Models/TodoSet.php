<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class TodoSet extends AbstractModel
{
    /**
     * Get the to-do set.
     *
     * @return \Illuminate\Http\Collection
     */
    public function show()
    {
        return Basecamp::todoSets($this->bucket->id)->show($this->id);
    }

    /**
     * List the to-do lists.
     *
     * @return \Illuminate\Http\Collection
     */
    public function todoLists()
    {
        return Basecamp::todoLists($this->bucket->id, $this->id);
    }
}
