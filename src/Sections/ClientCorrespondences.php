<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\ClientCorrespondence;

class ClientCorrespondences extends AbstractSection
{
    /**
     * Index all correspondences.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/client/correspondences.json', $this->bucket);

        $correspondences = $this->client->get($url);

        return $this->indexResponse($correspondences, ClientCorrespondence::class);
    }

    /**
     * Get a client correspondence.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $correspondence = $this->client->get(
            sprintf('buckets/%d/client/correspondences/%d.json', $this->bucket, $id)
        );

        return new ClientCorrespondence($this->response($correspondence));
    }
}
