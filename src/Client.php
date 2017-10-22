<?php

namespace Belvedere\Basecamp;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use Illuminate\Cache\Repository;
use ReflectionClass;

class Client
{
    /**
     * The authorization token url.
     *
     * @var string
     */
    const AUTH_TOKEN = 'https://launchpad.37signals.com/authorization/token';

    /**
     * The Http Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * The Cache store.
     *
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * The Http Client custom middlewares.
     *
     * @var mixed
     */
    protected $middlewares = [];

    /**
     * The Client configuration.
     *
     * @var array
     */
    protected $config;

    /**
     * Start the basecamp client.
     *
     * @param  array $config
     * @return void
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Set the basecamp API credentials.
     *
     * @param  array  $api
     * @return void
     */
    public function init($api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * Dispatch to a Basecamp API section.
     *
     */
    public function __call($class, $parameters)
    {
        $className = __NAMESPACE__.'\\Sections\\'.ucfirst($class);

        if (class_exists($className)) {
            return call_user_func_array(array(
                new ReflectionClass($className), 'newInstance'
            ), array($this->getHttpClient(), $parameters));
        }
    }

    /**
     * Get the Http Client.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getHttpClient()
    {
        if (is_null($this->httpClient)) {

            $handlerStack = $this->createHandlerStack();

            return new Guzzle([
                'base_uri' => rtrim($this->api['href'],'/').'/',
                'handler' => $handlerStack,
            ]);
        }

        return $this->httpClient;
    }

    /**
     * Set the cache store.
     *
     * @param  \Illuminate\Cache\Repository  $cache
     * @return void
     */
    public function setCache(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Set custom middlewares.
     *
     * @param  array  $middlewares
     * @return void
     */
    public function setMiddlewares(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * Create an Handler Stack to pass Middlewares to Guzzle.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    protected function createHandlerStack()
    {
        $stack = HandlerStack::create(new CurlHandler());

        $stack->push(ClientMiddlewares::cache($this->cache));
        $stack->push(
            ClientMiddlewares::setBaseHeaders(
                $this->api['token'], $this->config['basecamp.user-agent']
            )
        );
        $stack->push(
            ClientMiddlewares::retry($this->api, $this->config)
        );

        // Add custom middlewares.
        foreach ($this->middlewares as $middleware) {
            $stack->push($middleware);
        }

        return $stack;
    }
}
