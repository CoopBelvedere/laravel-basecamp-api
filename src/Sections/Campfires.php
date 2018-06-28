<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Campfire;
use Belvedere\Basecamp\Models\CampfireLine;

class Campfires extends AbstractSection
{
    /**
     * Index all campfires.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null)
    {
        $url = 'chats.json';

        $campfires = $this->client->get($url, [
            'query' => [
                'page' => $page,
            ],
        ]);

        return $this->indexResponse($campfires, Campfire::class);
    }

    /**
     * Get a campfire.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $campfire = $this->client->get(
            sprintf('buckets/%d/chats/%d.json', $this->bucket, $id)
        );

        return new Campfire($this->response($campfire));
    }

    /**
     * Get a campfire lines.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function lines($page = null)
    {
        $url = sprintf('buckets/%d/chats/%d/lines.json', $this->bucket, $this->parent);

        $lines = $this->client->get($url, [
            'query' => [
                'page' => $page,
            ]
        ]);

        return $this->indexResponse($lines, CampfireLine::class);
    }

    /**
     * Get a single campfire line.
     *
     * @param  int  $line
     * @return \Illuminate\Support\Collection
     */
    public function line($line)
    {
        $line = $this->client->get(
            sprintf('buckets/%d/chats/%d/lines/%d.json', $this->bucket, $this->parent, $line)
        );

        return new CampfireLine($this->response($line));
    }

    /**
     * Create a Campfire line.
     *
     * @param  string $content
     * @return \Illuminate\Support\Collection
     */
    public function storeLine($content)
    {
        $line = $this->client->post(
            sprintf('buckets/%d/chats/%d/lines.json', $this->bucket, $this->parent),
            [
                'json' => [
                    'content' => $content,
                ],
            ]
        );

        return new CampfireLine($this->response($line));
    }
}
