<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Needle;

class Needles extends AbstractSection
{
    /**
     * Get the needle.
     *
     * @param  int  $id
     * @return \Belvedere\Basecamp\Models\Needle
     */
    public function show($id)
    {
        return new Needle($this->client->get(sprintf('projects/%d/gauge/needles.json', $id)));
    }

    public function update($id, array $data)
    {
        $needle = $this->client->post(sprintf('projects/%d/gauge/needles.json', $id), [
            'json' => $data,
        ]);

        return new Needle($this->response($needle));
    }
}
