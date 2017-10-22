<?php

namespace Belvedere\Basecamp\Models;

use Belvedere\Basecamp\Models\Traits\Commentable;

class Message extends Recording
{
    use Commentable;

    /**
     * Update the message.
     *
     * @param  string  $content
     * @return \Illuminate\Http\Collection
     */
    public function update($content)
    {
        $message = Basecamp::messages($this->bucket->id)
                           ->update($this->id, $content);

        $this->setAttributes($message);

        return $message;
    }
}
