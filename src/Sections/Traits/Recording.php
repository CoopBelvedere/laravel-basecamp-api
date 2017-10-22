<?php

namespace Belvedere\Basecamp\Sections\Traits;

use Basecamp;

trait Recording
{
    /**
     * Destroy a recording.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        return Basecamp::recordings($this->bucket)->destroy($id);
    }
}
