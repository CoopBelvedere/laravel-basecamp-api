<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class MessageBoard extends AbstractModel
{
    /**
     * Get the message board.
     *
     * @return \Illuminate\Http\Collection
     */
    public function show()
    {
        return Basecamp::messageBoards($this->bucket->id)->show($this->id);
    }

    /**
     * List the messages.
     *
     * @return \Illuminate\Http\Collection
     */
    public function messages()
    {
        return Basecamp::messages($this->bucket->id, $this->id);
    }
}
