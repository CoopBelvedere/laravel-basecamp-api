<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Needle extends AbstractModel
{
    /**
     * Get the Needle State.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Collection
     */
    public function show($project_id)
    {
        return Basecamp::needles()->show($this->project_id);
    }

    /**
     * Update the Needle State.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Collection
     */
    public function update(array $data)
    {
        $needle = Basecamp::needles()->update($this->project_id, $data);

        $this->setAttributes($needle);

        return $needle;
    }

}