<?php

namespace App\SocialProviders;

use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;

class PloiProvider extends AbstractProvider implements ProviderInterface
{
    protected $baseUrl = 'https://ploi.io';

    protected $scopes = [
        'email avatar expire-date',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        if (app()->isLocal()) {
            $this->baseUrl = 'http://ploi.test';
        }

        return $this->buildAuthUrlFromBase($this->baseUrl . '/oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        if (app()->isLocal()) {
            $this->baseUrl = 'http://ploi.test';
        }

        return $this->baseUrl . '/oauth/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_add(
            parent::getTokenFields($code),
            'grant_type',
            'authorization_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        if (app()->isLocal()) {
            $this->baseUrl = 'http://ploi.test';
        }

        $response = $this->getHttpClient()->get($this->baseUrl . '/api/oauth/user', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Format the given scopes.
     *
     * @param array  $scopes
     * @param string $scopeSeparator
     *
     * @return string
     */
    protected function formatScopes(array $scopes, $scopeSeparator)
    {
        return implode($scopeSeparator, $scopes);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        $user = array_get($user, 'data');

        return (new User)->setRaw($user)->map([
            'id' => $user['email'],
            'name' => $user['name'],
            'email' => $user['email'],
            'avatar' => $user['avatar'],
            'country' => $user['country'],
            'timezone' => $user['timezone'],
            'plan_expires_at' => $user['plan_expires_at']
        ]);
    }
}
