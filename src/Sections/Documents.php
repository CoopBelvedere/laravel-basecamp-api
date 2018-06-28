<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Document;
use Belvedere\Basecamp\Sections\Traits\Recording;

class Documents extends AbstractSection
{
    use Recording;

    /**
     * Index all documents.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null)
    {
        $url = sprintf('buckets/%d/vaults/%d/documents.json', $this->bucket, $this->parent);

        $documents = $this->client->get($url, [
            'query' => [
                'page' => $page,
            ],
        ]);

        return $this->indexResponse($documents, Document::class);
    }

    /**
     * Get a document.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $document = $this->client->get(
            sprintf('buckets/%d/documents/%d.json', $this->bucket, $id)
        );

        return new Document($this->response($document));
    }

    /**
     * Store a document.
     *
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function store($data)
    {
        $document = $this->client->post(
            sprintf('buckets/%d/vaults/%d/documents.json', $this->bucket, $this->parent),
            [
                'json' => $data,
            ]
        );

        return new Document($this->response($document));
    }

    /**
     * Update a document.
     *
     * @param  int     $id
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, $data)
    {
        $document = $this->client->put(
            sprintf('buckets/%d/documents/%d.json', $this->bucket, $id),
            [
                'json' => $data,
            ]
        );

        return new Document($this->response($document));
    }
}
