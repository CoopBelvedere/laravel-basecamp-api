<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\TodoList;

class TodoLists extends AbstractSection
{
    /**
     * Index all to-do lists.
     *
     * @param  string  $nextPage
     * @param  string  $status
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null, $status = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/todosets/%d/todolists.json', $this->bucket, $this->parent);

        $todolists = $this->client->get($url, [
            'query' => ['status' => $status],
        ]);

        return $this->indexResponse($todolists, TodoList::class);
    }

    /**
     * Index archived to-do lists.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function archived($nextPage = null)
    {
        return $this->index($nextPage, 'archived');
    }

    /**
     * Index trashed to-do lists.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function trashed($nextPage = null)
    {
        return $this->index($nextPage, 'trashed');
    }

    /**
     * Get a to-do list.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $todolist = $this->client->get(
            sprintf('buckets/%d/todolists/%d.json', $this->bucket, $id)
        );

        return new TodoList($this->response($todolist));
    }

    /**
     * Store a to-do list.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function store(array $data)
    {
        $todolist = $this->client->post(
            sprintf('buckets/%d/todosets/%d/todolists.json', $this->bucket, $this->parent),
            [
                'json' => $data,
            ]
        );

        return new TodoList($this->response($todolist));
    }

    /**
     * Update a to-do list.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, array $data)
    {
        $todolist = $this->client->put(
            sprintf('buckets/%d/todolists/%d.json', $this->bucket, $id),
            [
                'json' => $data,
            ]
        );

        return new TodoList($this->response($todolist));
    }
}
