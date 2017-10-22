<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Comment;
use Belvedere\Basecamp\Sections\Traits\Recording;

class Comments extends AbstractSection
{
    use Recording;

    /**
     * Index all comments.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/recordings/%d/comments.json', $this->bucket, $this->parent);

        $comments = $this->client->get($url);

        return $this->indexResponse($comments, Comment::class);
    }

    /**
     * Get a comment.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $comment = $this->client->get(
            sprintf('buckets/%d/comments/%d.json', $this->bucket, $id)
        );

        return new Comment($this->response($comment));
    }

    /**
     * Store a comment.
     *
     * @param  string  $content
     * @return \Illuminate\Support\Collection
     */
    public function store($content)
    {
        $comment = $this->client->post(
            sprintf('buckets/%d/recordings/%d/comments.json', $this->bucket, $this->parent),
            [
                'json' => [
                    'content' => $content,
                ],
            ]
        );

        return new Comment($this->response($comment));
    }

    /**
     * Update a comment.
     *
     * @param  int     $id
     * @param  string  $content
     * @return \Illuminate\Support\Collection
     */
    public function update($id, $content)
    {
        $comment = $this->client->put(
            sprintf('buckets/%d/comments/%d.json', $this->bucket, $id),
            [
                'json' => [
                    'content' => $content,
                ],
            ]
        );

        return  new Comment($this->response($comment));
    }
}
