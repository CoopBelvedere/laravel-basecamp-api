<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Subscription;
use GuzzleHttp\Client;

class Subscriptions extends AbstractSection
{
    /**
     * Store the api url for this section.
     *
     * @var string
     */
    protected $url;

    /**
     * Check for url in of bucket.
     *
     * @param  \GuzzleHttp\Client $client
     * @param  array              $parameters
     * @return void
     */
    public function __construct(Client $client, array $parameters = [])
    {
        parent::__construct($client, $parameters);

        if (filter_var($this->bucket, FILTER_VALIDATE_URL)) {
            $this->url = $this->bucket;
        } else {
            $this->url = sprintf('buckets/%d/recordings/%d/subscription.json', $this->bucket, $this->parent);
        }
    }

    /**
     * Show subscription info for a recording.
     *
     * @return \Belvedere\Basecamp\Models\Subscription
     */
    public function show()
    {
        $subscription = $this->client->get($this->url);

        return new Subscription($this->response($subscription));
    }

    /**
     * Subscribe the current user.
     *
     * @return \Belvedere\Basecamp\Models\Subscription
     */
    public function subscribe()
    {
        $subscription = $this->client->post($this->url);

        return new Subscription($this->response($subscription));
    }

    /**
     * Unsubscribe the current user.
     *
     * @return string
     */
    public function unsubscribe()
    {
        return $this->client->delete($this->url);
    }

    /**
     * Update the subscription.
     *
     * @param  array  $data
     * @return \Belvedere\Basecamp\Models\Subscription
     */
    public function update(array $data)
    {
        $subscription = $this->client->put(
            $this->url,
            [
                'json' => $data,
            ]
        );

        return new Subscription($this->response($subscription));
    }
}
