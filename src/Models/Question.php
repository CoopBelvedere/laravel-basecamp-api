<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Question extends AbstractModel
{
    /**
     * List the answers.
     *
     * @return \Illuminate\Http\Collection
     */
    public function answers()
    {
        return Basecamp::questionAnswers($this->bucket->id, $this->id);
    }
}
