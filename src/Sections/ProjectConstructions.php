<?php

namespace Belvedere\Basecamp\Sections;

class ProjectConstructions extends AbstractSection
{
    /**
     * Get a project construction.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $projectConstructions = $this->client->get(
            sprintf('templates/%d/project_constructions/%d.json', $this->parent, $id)
        );

        return $this->response($projectConstructions);
    }

    /**
     * Create a project construction.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function store(array $data)
    {
        $projectConstruction = $this->client->post(
            sprintf('templates/%d/project_constructions.json', $this->parent),
            [
                'json' => $data,
            ]
        );

        return $this->response($projectConstruction);
    }
}
