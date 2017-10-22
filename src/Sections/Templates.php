<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Template;

class Templates extends AbstractSection
{
    /**
     * Index all templates.
     *
     * @param  string  $nextPage
     * @param  string  $status
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null, $status = null)
    {
        $url = $nextPage ?: 'templates.json';

        $templates = $this->client->get($url, [
            'query' => ['status' => $status],
        ]);

        return $this->indexResponse($templates, Template::class);
    }

    /**
     * Index archived templates.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function archived($nextPage = null)
    {
        return $this->index($nextPage, 'archived');
    }

    /**
     * Index trashed templates.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function trashed($nextPage = null)
    {
        return $this->index($nextPage, 'trashed');
    }

    /**
     * Get a template.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $template = $this->client->get(sprintf('templates/%d.json', $id));

        return new Template($this->response($template));
    }

    /**
     * Store a template.
     *
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function store($data)
    {
        $template = $this->client->post('templates.json', [
            'json' => $data,
        ]);

        return new Template($this->response($template));
    }

    /**
     * Update a message type.
     *
     * @param  int     $id
     * @param  array   $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, $data)
    {
        $message = $this->client->put(sprintf('templates/%d.json', $id), [
            'json' => $data,
        ]);

        return new Template($this->response($message));
    }

    /**
     * Destroy a template.
     *
     * @param  int     $id
     * @return \Illuminate\Support\Collection
     */
    public function destroy($id)
    {
        return $this->client->delete(sprintf('templates/%d.json', $id));
    }
}
