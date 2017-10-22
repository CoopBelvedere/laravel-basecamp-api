<?php

namespace Belvedere\Basecamp\Models;

class Template extends AbstractModel
{
    /**
     * Update the template.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Collection
     */
    public function update(array $data)
    {
        $template = Basecamp::templates()->update($this->id, $data);

        $this->setAttributes($template);

        return $template;
    }

    /**
     * Trash the template.
     *
     * @return \Illuminate\Http\Collection
     */
    public function destroy()
    {
        return Basecamp::templates()->destroy($this->id);
    }

    /**
     * Get the project Constructions.
     *
     * @return \Illuminate\Http\Collection
     */
    public function projectConstructions()
    {
        return Basecamp::projectConstructions(null, $this->id);
    }
}
