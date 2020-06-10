<?php

namespace Laravel\Socialite;

use Illuminate\Support\Arr;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Laravel\Socialite\One\TwitterProvider;
use Laravel\Socialite\Two\BitbucketProvider;
use Laravel\Socialite\Two\FacebookProvider;
use Laravel\Socialite\Two\GithubProvider;
use Laravel\Socialite\Two\GitlabProvider;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\LinkedInProvider;
use League\OAuth1\Client\Server\Twitter as TwitterServer;

class SocialiteManager extends Manager implements Contracts\Factory
{
    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     * @return mixed
     */
    public function with($driver)
    {
        return $this->driver($driver);
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createGithubDriver()
    {
<<<<<<< HEAD
        $config = $this->container->make('config')['services.github'];
=======
        $config = $this->app->make('config')['services.github'];
>>>>>>> 17e8b7f8298fe4762361c452be109f3dbc266557

        return $this->buildProvider(
            GithubProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createFacebookDriver()
    {
<<<<<<< HEAD
        $config = $this->container->make('config')['services.facebook'];
=======
        $config = $this->app->make('config')['services.facebook'];
>>>>>>> 17e8b7f8298fe4762361c452be109f3dbc266557

        return $this->buildProvider(
            FacebookProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createGoogleDriver()
    {
<<<<<<< HEAD
        $config = $this->container->make('config')['services.google'];
=======
        $config = $this->app->make('config')['services.google'];
>>>>>>> 17e8b7f8298fe4762361c452be109f3dbc266557

        return $this->buildProvider(
            GoogleProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createLinkedinDriver()
    {
<<<<<<< HEAD
        $config = $this->container->make('config')['services.linkedin'];
=======
        $config = $this->app->make('config')['services.linkedin'];
>>>>>>> 17e8b7f8298fe4762361c452be109f3dbc266557

        return $this->buildProvider(
          LinkedInProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createBitbucketDriver()
    {
<<<<<<< HEAD
        $config = $this->container->make('config')['services.bitbucket'];
=======
        $config = $this->app->make('config')['services.bitbucket'];
>>>>>>> 17e8b7f8298fe4762361c452be109f3dbc266557

        return $this->buildProvider(
          BitbucketProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createGitlabDriver()
    {
<<<<<<< HEAD
        $config = $this->container->make('config')['services.gitlab'];
=======
        $config = $this->app->make('config')['services.gitlab'];
>>>>>>> 17e8b7f8298fe4762361c452be109f3dbc266557

        return $this->buildProvider(
            GitlabProvider::class, $config
        );
    }

    /**
     * Build an OAuth 2 provider instance.
     *
     * @param  string  $provider
     * @param  array  $config
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    public function buildProvider($provider, $config)
    {
        return new $provider(
<<<<<<< HEAD
            $this->container->make('request'), $config['client_id'],
=======
            $this->app->make('request'), $config['client_id'],
>>>>>>> 17e8b7f8298fe4762361c452be109f3dbc266557
            $config['client_secret'], $this->formatRedirectUrl($config),
            Arr::get($config, 'guzzle', [])
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\One\AbstractProvider
     */
    protected function createTwitterDriver()
    {
<<<<<<< HEAD
        $config = $this->container->make('config')['services.twitter'];

        return new TwitterProvider(
            $this->container->make('request'), new TwitterServer($this->formatConfig($config))
=======
        $config = $this->app->make('config')['services.twitter'];

        return new TwitterProvider(
            $this->app->make('request'), new TwitterServer($this->formatConfig($config))
>>>>>>> 17e8b7f8298fe4762361c452be109f3dbc266557
        );
    }

    /**
     * Format the server configuration.
     *
     * @param  array  $config
     * @return array
     */
    public function formatConfig(array $config)
    {
        return array_merge([
            'identifier' => $config['client_id'],
            'secret' => $config['client_secret'],
            'callback_uri' => $this->formatRedirectUrl($config),
        ], $config);
    }

    /**
     * Format the callback URL, resolving a relative URI if needed.
     *
     * @param  array  $config
     * @return string
     */
    protected function formatRedirectUrl(array $config)
    {
        $redirect = value($config['redirect']);

        return Str::startsWith($redirect, '/')
<<<<<<< HEAD
                    ? $this->container->make('url')->to($redirect)
=======
                    ? $this->app->make('url')->to($redirect)
>>>>>>> 17e8b7f8298fe4762361c452be109f3dbc266557
                    : $redirect;
    }

    /**
     * Get the default driver name.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No Socialite driver was specified.');
    }
}
