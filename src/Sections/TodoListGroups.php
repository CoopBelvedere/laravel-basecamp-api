<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\TodoListGroup;

class TodoListGroups extends AbstractSection
{
    /**
     * Index all to-do list groups.
     *
     * @param  string  $nextPage
     * @param  string  $status
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null, $status = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/todolists/%d/groups.json', $this->bucket, $this->parent);

        $todolistGroups = $this->client->get($url, [
            'query' => ['status' => $status],
        ]);

        return $this->indexResponse($todolistGroups, TodoListGroup::class);
    }

    /**
     * Index archived to-do list groups.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function archived($nextPage = null)
    {
        return $this->index($nextPage, 'archived');
    }

    /**
     * Index trashed to-do list groups.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function trashed($nextPage = null)
    {
        return $this->index($nextPage, 'trashed');
    }

    /**
     * Get a to-do list group.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $todolistGroup = $this->client->get(
            sprintf('buckets/%d/todolists/%d.json', $this->bucket, $id)
        );

        return new TodoListGroup($this->response($todolistGroup));
    }

    /**
     * Store a to-do list group.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function store(array $data)
    {
        $todolistGroup = $this->client->post(
            sprintf('buckets/%d/todosets/%d/groups.json', $this->bucket, $this->parent),
            [
                'json' => $data,
            ]
        );

        return new TodoListGroup($this->response($todolistGroup));
    }

    /**
     * Reposition a to-do list group.
     *
     * @param  int    $id
     * @param  int    $position
     * @return \Illuminate\Support\Collection
     */
    public function reposition($id, $position)
    {
        return $this->client->put(
            sprintf('buckets/%d/todolists/groups/%d/position.json', $this->bucket, $id),
            [
                'json' => [
                    'position' => $position,
                ],
            ]
        );
    }
}
