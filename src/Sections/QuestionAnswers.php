<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\QuestionAnswer;

class QuestionAnswers extends AbstractSection
{
    /**
     * Index all the question answers.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/questions/%d/answers.json', $this->bucket, $this->parent);

        $answers = $this->client->get($url);

        return $this->indexResponse($answers, QuestionAnswer::class);
    }

    /**
     * Get a question answer.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($bucket, $id)
    {
        $answer = $this->client->get(
            sprintf('buckets/%d/question_answers/%d.json', $this->bucket, $id)
        );

        return new QuestionAnswer($this->response($answer));
    }
}
