<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Upload;
use Belvedere\Basecamp\Sections\Traits\Recording;

class Uploads extends AbstractSection
{
    use Recording;

    /**
     * Index all the uploads.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null)
    {
        $url = sprintf('buckets/%d/vaults/%d/uploads.json', $this->bucket, $this->parent);

        $uploads = $this->client->get($url, [
            'query' => [
                'page' => $page,
            ],
        ]);

        return $this->response($uploads, Upload::class);
    }

    /**
     * Get an upload.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $upload = $this->client->get(
            sprintf('buckets/%d/uploads/%d.json', $this->bucket, $id)
        );

        return new Upload($this->response($upload));
    }

    /**
     * Store an upload.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function store(array $data)
    {
        $upload = $this->client->post(
            sprintf('buckets/%d/vaults/%d/uploads.json', $this->bucket, $this->parent),
            [
                'json' => $data,
            ]
        );

        return new Upload($this->response($upload));
    }

    /**
     * Update an upload.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, array $data)
    {
        $upload = $this->client->put(
            sprintf('buckets/%d/uploads/%d.json', $this->bucket, $id),
            [
                'json' => $data,
            ]
        );

        return new Upload($this->response($upload));
    }
}
