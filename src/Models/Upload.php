<?php

namespace Belvedere\Basecamp\Models;

use Belvedere\Basecamp\Models\Traits\Commentable;

class Upload extends Recording
{
    use Commentable;

    /**
     * Update the upload.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Collection
     */
    public function update(array $data)
    {
        $upload = Basecamp::uploads($this->bucket->id)
                          ->update($this->id, $data);

        $this->setAttributes($upload);

        return $upload;
    }
}
