<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Project;

class Projects extends AbstractSection
{
    /**
     * Index all projects.
     *
     * @param  int     $page
     * @param  string  $status
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null, $status = null)
    {
        $url = 'projects.json';

        $projects = $this->client->get($url, [
            'query' => [
                'status' => $status,
                'page' => $page,
            ],
        ]);

        return $this->indexResponse($projects, Project::class);
    }

    /**
     * Index archived projects.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function archived($page = null)
    {
        return $this->index($page, 'archived');
    }

    /**
     * Index trashed projects.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function trashed($page = null)
    {
        return $this->index($page, 'trashed');
    }

    /**
     * Show a single project.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $project = $this->client->get(sprintf('projects/%d.json', $id));

        return new Project($this->response($project));
    }

    /**
     * Store a project.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function store(array $data)
    {
        $project = $this->client->post('projects.json', [
            'json' => $data,
        ]);

        if (property_exists($project, 'error'))
            throw new \Exception($project->error);

        return new Project($this->response($project));
    }

    /**
     * Update a project.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function update($id, array $data)
    {
        $project = $this->client->put(sprintf('projects/%d.json', $id), [
            'json' => $data,
        ]);

        return new Project($this->response($project));
    }

    /**
     * Trash a project.
     *
     * @param  int    $id
     * @return \Illuminate\Support\Collection
     */
    public function destroy($id)
    {
        return $this->client->delete(sprintf('projects/%d.json', $id));
    }
}
