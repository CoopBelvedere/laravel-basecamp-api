<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Attachment;

class Attachments extends AbstractSection
{
    /**
     * Store a new attachment.
     *
     * @param  string  $name
     * @param  string  $path
     * @return \Illuminate\Support\Collection
     */
    public function store($name, $path)
    {
        $rawData = file_get_contents($path);

        $attachment = $this->client->post('attachments.json', [
            'query' => [
                'name' => $name,
            ],
            'body' => $rawData,
            'headers' => [
                'Content-Type' => mime_content_type($path),
                'Content-Length' => filesize($path),
            ],
        ]);

        return $this->response($attachment);
    }
}
