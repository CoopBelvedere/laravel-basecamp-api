<?php

namespace Belvedere\Basecamp\Models;

class Comment extends Recording
{
    /**
     * Update the comment.
     *
     * @param  string  $content
     * @return \Illuminate\Http\Collection
     */
    public function update($content)
    {
        $comment = Basecamp::comments($this->bucket->id)
                           ->update($this->id, $content);

        $this->setAttributes($comment);

        return $comment;
    }
}
