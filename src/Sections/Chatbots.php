<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Chatbot;

class Chatbots extends AbstractSection
{
    /**
     * Index all chatbots.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/chats/%d/integrations.json', $this->bucket, $this->parent);

        $chatbots = $this->client->get($url);

        return $this->indexResponse($chatbots, Chatbot::class)->map(function ($chatbot) {
            $chatbot->inContext($this->bucket, $this->parent);
            return $chatbot;
        });
    }

    /**
     * Get a chatbot.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $chatbot = $this->client->get(
            sprintf('buckets/%d/chats/%d/integrations/%d.json', $this->bucket, $this->parent, $id)
        );
        $chatbot = new Chatbot($this->response($chatbot));
        $chatbot->inContext($this->bucket, $this->parent);

        return $chatbot;
    }

    /**
     * Create a chatbot.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function store(array $data)
    {
        $chatbot = $this->client->post(
            sprintf('buckets/%d/chats/%d/integrations.json', $this->bucket, $this->parent),
            [
                'json' => $data,
            ]
        );
        $chatbot = new Chatbot($this->response($chatbot));
        $chatbot->inContext($this->bucket, $this->parent);

        return $chatbot;
    }

    /**
     * Update a chatbot.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, array $data)
    {
        $chatbot = $this->client->put(
            sprintf('buckets/%d/chats/%d/integrations/%d.json', $this->bucket, $this->parent, $id),
            [
                'json' => $data
            ]
        );
        $chatbot = new Chatbot($this->response($chatbot));
        $chatbot->inContext($this->bucket, $this->parent);

        return $chatbot;
    }

    /**
     * Delete a chatbot.
     *
     * @param  int    $id
     * @return \Illuminate\Support\Collection
     */
    public function destroy($id)
    {
        return $this->client->delete(
            sprintf('buckets/%d/chats/%d/integrations/%d.json', $this->bucket, $this->parent, $id)
        );
    }

    /**
     * Store a campfire line with the chatbot account.
     *
     * @param  string  $content
     * @return \Illuminate\Http\Collection
     */
    public function storeLine($url, $content)
    {
        return $this->client->post($url, [
            'json' => [
                'content' => $content
            ]
        ]);
    }
}
