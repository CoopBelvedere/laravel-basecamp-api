<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Questionnaire extends AbstractModel
{
    /**
     * Get the questionnaire.
     *
     * @return \Illuminate\Http\Collection
     */
    public function show()
    {
        return Basecamp::questionnaires($this->bucket->id)->show($this->id);
    }

    /**
     * List the questions.
     *
     * @return \Illuminate\Http\Collection
     */
    public function questions()
    {
        return Basecamp::questions($this->bucket->id, $this->id);
    }
}
