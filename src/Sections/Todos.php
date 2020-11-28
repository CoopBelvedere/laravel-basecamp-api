<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Todo;

class Todos extends AbstractSection
{
    /**
     * Index all the to-dos.
     *
     * @param  int     $page
     * @param  string  $status
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null, $status = null, $completed = null)
    {
        $url = sprintf('buckets/%d/todolists/%d/todos.json', $this->bucket, $this->parent);

        $todos = $this->client->get($url, [
            'query' => [
                'status' => $status,
                'page' => $page,
                'completed' => $completed ? 'true' : null,
            ],
        ]);

        return $this->indexResponse($todos, Todo::class);
    }

    /**
     * Index archived to-dos.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function archived($page = null)
    {
        return $this->index($page, 'archived');
    }

    /**
     * Index trashed to-dos.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function trashed($page = null)
    {
        return $this->index($page, 'trashed');
    }

    /**
     * Index completed to-dos.
     *
     * @param  int  $page
     * @param  string  $status
     * @return \Illuminate\Support\Collection
     */
    public function completed($page = null, $status = null)
    {
        return $this->index($page, $status, 'completed');
    }

    /**
     * Get a to-do.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $todo = $this->client->get(
            sprintf('buckets/%d/todos/%d.json', $this->bucket, $id)
        );

        return new Todo($this->response($todo));
    }

    /**
     * Store a to-do.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function store(array $data)
    {
        $todo = $this->client->post(
            sprintf('buckets/%d/todolists/%d/todos.json', $this->bucket, $this->parent),
            [
                'json' => $data,
            ]
        );

        return new Todo($this->response($todo));
    }

    /**
     * Update a to-do.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, array $data)
    {
        $todo = $this->client->put(
            sprintf('buckets/%d/todos/%d.json', $this->bucket, $id),
            [
                'json' => $data,
            ]
        );

        return new Todo($this->response($todo));
    }

    /**
     * Complete a to-do.
     *
     * @param  int    $id
     * @return \Illuminate\Support\Collection
     */
    public function complete($id)
    {
        return $this->client->post(
            sprintf('buckets/%d/todos/%d/completion.json', $this->bucket, $id)
        );
    }

    /**
     * Uncomplete a to-do.
     *
     * @param  int    $id
     * @return \Illuminate\Support\Collection
     */
    public function uncomplete($id)
    {
        return $this->client->delete(
            sprintf('buckets/%d/todos/%d/completion.json', $this->bucket, $id)
        );
    }

    /**
     * Reposition a to-do.
     *
     * @param  int    $id
     * @param  int    $position
     * @return \Illuminate\Support\Collection
     */
    public function reposition($id, $position)
    {
        return $this->client->put(
            sprintf('buckets/%d/todos/%d/position.json', $this->bucket, $id),
            [
                'json' => [
                    'position' => $position,
                ],
            ]
        );
    }
}
