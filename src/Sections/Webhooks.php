<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Webhook;

class Webhooks extends AbstractSection
{
    /**
     * Index all webhooks.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/webhooks.json', $this->bucket);

        $webhooks = $this->client->get($url);

        return $this->indexResponse($webhooks, Webhook::class)->map(function ($webhook) {
            $webhook->inContext($this->bucket);
            return $webhook;
        });
    }

    /**
     * Get a webhook.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $webhook = $this->client->get(
            sprintf('buckets/%d/webhooks/%d.json', $this->bucket, $id)
        );
        $webhook = new Webhook($this->response($webhook));
        $webhook->inContext($this->bucket);

        return $webhook;
    }

    /**
     * Store a webhook.
     *
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function store(array $data)
    {
        $webhook = $this->client->post(
            sprintf('buckets/%d/webhooks.json', $this->bucket),
            [
                'json' => $data,
            ]
        );
        $webhook = new Webhook($this->response($webhook));
        $webhook->inContext($this->bucket);

        return $webhook;
    }

    /**
     * Update a webhook.
     *
     * @param  int     $id
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, $data)
    {
        $webhook = $this->client->put(
            sprintf('buckets/%d/webhooks/%d.json', $this->bucket, $id),
            [
                'json' => $data,
            ]
        );
        $webhook = new Webhook($this->response($webhook));
        $webhook->inContext($this->bucket);

        return $webhook;
    }

    /**
     * Destroy a webhook.
     *
     * @param  int     $id
     * @return \Illuminate\Support\Collection
     */
    public function destroy($id)
    {
        return $this->client->delete(
            sprintf('buckets/%d/webhooks/%d.json', $this->bucket, $id)
        );
    }
}
