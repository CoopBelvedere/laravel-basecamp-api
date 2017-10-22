<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Campfire extends AbstractModel
{
    /**
     * Get the campfire.
     *
     * @return \Illuminate\Http\Collection
     */
    public function show()
    {
        return Basecamp::campfires($this->bucket->id)->show($this->id);
    }

    /**
     * Get a Campfire lines.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Http\Collection
     */
    public function lines($nextPage = null)
    {
        return Basecamp::campfires($this->bucket->id, $this->id)
                       ->lines($nextPage);
    }

    /**
     * Get a single campfire lines.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Collection
     */
    public function line($id)
    {
        return Basecamp::campfires($this->bucket->id, $this->id)->line($id);
    }

    /**
     * Add a campfire line.
     *
     * @param  string  $content
     * @return \Illuminate\Http\Collection
     */
    public function storeLine($content)
    {
        return Basecamp::campfires($this->bucket->id, $this->id)
                       ->storeLine($content);
    }

    /**
     * Get a Campfire chatbots.
     *
     * @return \Illuminate\Http\Collection
     */
    public function chatbots()
    {
        return Basecamp::chatbots($this->bucket->id, $this->id);
    }
}
