<?php

namespace Belvedere\Basecamp;

use Belvedere\Basecamp\Contracts\BasecampModel;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Illuminate\Cache\FileStore;
use Illuminate\Cache\Repository;
use Illuminate\Filesystem\Filesystem;

class ClientMiddlewares
{
    /**
     * Cache middleware.
     *
     * Set the cache middleware for the guzzle requests.
     *
     * @param  \Illuminate\Cache\Repository  $cache
     * @return \Kevinrob\GuzzleCache\CacheMiddleware
     */
    public static function cache(Repository $cache = null)
    {
        if (! $cache) {
            $filestore = new FileStore(new Filesystem(), storage_path());
            $cache = new Repository($filestore);
        }

        return new CacheMiddleware(
            new PrivateCacheStrategy(
                new LaravelCacheStorage($cache)
            )
        );
    }

    /**
     * Set the base request headers.
     *
     * This is called in the handler stack instead of the Client instance
     * in case the user's basecamp token is refreshed between requests.
     *
     * @param  string  $token
     * @param  string  $userAgent
     * @return \GuzzleHttp\Middleware
     */
    public static function setBaseHeaders($token, $userAgent)
    {
        return Middleware::mapRequest(
            function (Request $request) use ($token, $userAgent) {
                return $request->withHeader('Accept', 'application/json')
                               ->withHeader('Authorization', 'Bearer '.$token)
                               ->withHeader('User-Agent', $userAgent);
            }
        );
    }

    /**
     * Retry middleware.
     *
     * Return a boolean if the request should be re-sent.
     *
     * @param  array  $config
     * @return \GuzzleHttp\Middleware
     */
    public static function retry(&$api, $config)
    {
        $retryRequest = function (
            $retries, $request, $response, $error
        ) use ($api, $config) {
            // Refresh token middleware
            if ($response and $response->getStatusCode() == 401) {
                return self::refreshToken($api, $config, $retries);
            }

            // Don't retry on other requests.
            return false;
        };

        return Middleware::retry($retryRequest);
    }

    /**
     * Refresh the user token.
     *
     * @param  array  $api
     * @param  array  $config
     * @param  int    $retries
     * @return boolean
     */
    protected static function refreshToken(&$api, $config, $retries = 0)
    {
        if ($retries >= 3) {
            return false; // Give up after 3 tries.
        }

        $response = (new Guzzle)->post(Client::AUTH_TOKEN, [
            'form_params' => [
                'type' => 'refresh',
                'refresh_token' => $api['refresh_token'],
                'client_id' => $config['services.37signals.client_id'],
                'client_secret' => $config['services.37signals.client_secret'],
                'redirect_uri' => $config['services.37signals.redirect'],
            ],
        ]);

        if (! $response or $response->getStatusCode() >= 400) {
            throw new \Exception('Error trying to connect.');
        }

        $token = json_decode($response->getBody());

        $api['token'] = $token->access_token;

        event('basecamp.refreshed_token', [$api['id'], $token]);

        // Now that we have a new access token, retry the original request.
        return true;
    }
}
