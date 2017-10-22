<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Project extends AbstractModel
{
    /**
     * Get the project campfire.
     *
     * @return \Illuminate\Http\Collection
     */
    public function campfire()
    {
        $campfire = collect($this->dock)->where('name', 'chat')->first();
        $campfire->bucket = $this;
        return new Campfire($campfire);
    }

    /**
     * Get the project message board.
     *
     * @return \Illuminate\Http\Collection
     */
    public function messageBoard()
    {
        $messageBoard = collect($this->dock)->where('name', 'message_board')
                                            ->first();
        $messageBoard->bucket = $this;
        return new MessageBoard($messageBoard);
    }

    /**
     * Get the project todos.
     *
     * @return \Illuminate\Http\Collection
     */
    public function todoSet()
    {
        $todos = collect($this->dock)->where('name', 'todoset')->first();
        $todos->bucket = $this;
        return new TodoSet($todos);
    }

    /**
     * Get the project schedule.
     *
     * @return \Illuminate\Http\Collection
     */
    public function schedule()
    {
        $schedule = collect($this->dock)->where('name', 'schedule')->first();
        $schedule->bucket = $this;
        return new Schedule($schedule);
    }

    /**
     * Get the project automatic check-ins.
     *
     * @return \Illuminate\Http\Collection
     */
    public function questionnaire()
    {
        $questionnaire = collect($this->dock)->where('name', 'questionnaire')
                                             ->first();
        $questionnaire->bucket = $this;
        return new Questionnaire($questionnaire);
    }

    /**
     * Get the project docs and files.
     *
     * @return \Illuminate\Http\Collection
     */
    public function vault()
    {
        $vault = collect($this->dock)->where('name', 'vault')->first();
        $vault->bucket = $this;
        return new Vault($vault);
    }

    /**
     * Get the project docs and files.
     *
     * @return \Illuminate\Http\Collection
     */
    public function inbox()
    {
        $inbox = collect($this->dock)->where('name', 'inbox')->first();
        $inbox->bucket = $this;
        return new Inbox($inbox);
    }

    /**
     * Get the project webhooks.
     *
     * @return \Illuminate\Http\Collection
     */
    public function webhooks()
    {
        return Basecamp::webhooks($this->id);
    }

    /**
     * Get the project message types.
     *
     * @return \Illuminate\Http\Collection
     */
    public function messageTypes()
    {
        return Basecamp::messageTypes($this->id);
    }

    /**
     * Get a project client approvals.
     *
     * @return \Illuminate\Http\Collection
     */
    public function clientApprovals()
    {
        return Basecamp::clientApprovals($this->id);
    }

    /**
     * Get a project client correspondences.
     *
     * @return \Illuminate\Http\Collection
     */
    public function clientCorrespondences()
    {
        return Basecamp::clientCorrespondences($this->id);
    }

    /**
     * Update the project.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Collection
     */
    public function update(array $data)
    {
        $project = Basecamp::projects()->update($this->id, $data);

        $this->setAttributes($project);

        return $project;
    }

    /**
     * Delete the project
     *
     * @return \Illuminate\Http\Collection
     */
    public function destroy()
    {
        return Basecamp::projects()->destroy($this->id);
    }
}
