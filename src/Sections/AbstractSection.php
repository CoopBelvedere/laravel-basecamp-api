<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\IndexCollection;
use GuzzleHttp\Client;

abstract class AbstractSection
{
    /**
     * The Guzzle Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The bucket (project) ID.
     *
     * @var int
     */
    protected $bucket;

    /**
     * The parent ID.
     *
     * @var int
     */
    protected $parent;

    /**
     * Assign the client to the Basecamp API Section.
     *
     * @param  \GuzzleHttp\Client $client
     * @param  array              $parameters
     * @return void
     */
    public function __construct(Client $client, array $parameters = [])
    {
        $this->client = $client;
        $this->bucket = $parameters[0] ?? null;
        $this->parent = $parameters[1] ?? null;
    }

    /**
     * Return the formatted json response to a collection.
     *
     * @param  \GuzzleHttp\Psr7\Response  $response
     * @return \Illuminate\Support\Collection
     */
    public function response($response)
    {
        return json_decode($response->getBody());
    }

    /**
     * Return an index response with pagination.
     *
     * @param  \GuzzleHttp\Psr7\Response  $response
     * @param  string                     $class
     * @return \Illuminate\Support\Collection
     */
    public function indexResponse($response, $class)
    {
        $resources = $this->response($response);

        $collection = (new IndexCollection($resources))->map(
            function($resource) use ($class) {
                return new $class($resource);
            }
        );

        $link = $response->getHeader('Link')[0] ?? null;
        $total = $response->getHeader('X-Total-Count')[0] ?? null;

        $collection->setPagination($this->getPageNumber($link), (int) $total);

        return $collection;
    }

    /**
     * Format the link request header.
     *
     * @param  string  $link
     * @return string
     */
    protected function getPageNumber($link)
    {
        if ($link) {
            $url = str_replace(
                'rel="next"', '', preg_replace('/[<>;\ ]/', '', $link)
            );
            parse_str(parse_url($url, PHP_URL_QUERY), $output);

            return (int) $output['page'];
        }

        return null;
    }
}
