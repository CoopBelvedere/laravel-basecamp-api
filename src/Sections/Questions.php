<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Question;

class Questions extends AbstractSection
{
    /**
     * Index all the questions.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/questionnaires/%d/questions.json', $this->bucket, $this->parent);

        $questions = $this->client->get($url);

        return $this->indexResponse($questions, Question::class);
    }

    /**
     * Get a question.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $question = $this->client->get(
            sprintf('buckets/%d/questions/%d.json', $this->bucket, $id)
        );

        return new Question($this->response($question));
    }
}
