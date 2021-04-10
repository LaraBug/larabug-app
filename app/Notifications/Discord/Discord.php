<?php

namespace App\Notifications\Discord;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use App\Exceptions\CouldNotSendNotification;

class Discord
{
    /** @var string */
    protected $baseUrl = 'https://discordapp.com/api';

    /** @var \GuzzleHttp\Client */
    protected $httpClient;

    /**
     * @param  \GuzzleHttp\Client $http
     */
    public function __construct(HttpClient $http)
    {
        $this->httpClient = $http;
    }

    /**
     * @param        $notifiable
     * @param  array $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($notifiable, array $data)
    {
        return $this->request('POST', $notifiable->routeNotificationForDiscord(), $data);
    }

    /**
     * @param  mixed $user
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPrivateChannel($user)
    {
        return $this->request('POST', 'users/@me/channels', ['recipient_id' => $user])['id'];
    }

    /**
     * @param         $verb
     * @param  string $endpoint
     * @param  array  $data
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request($verb, $endpoint, array $data)
    {
        $url = $endpoint;

        $response = null;

        try {
            $response = $this->httpClient->request($verb, $url, [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);
        } catch (RequestException $exception) {
            info('DSERROR1:' . $exception->getMessage());
//            throw CouldNotSendNotification::serviceRespondedWithAnHttpError($exception->getResponse());
        } catch (Exception $exception) {
            info('DSERROR2:' .$exception->getMessage());
//            throw CouldNotSendNotification::serviceCommunicationError($exception);
        }

        if (!$response) {
            return;
        }

        return json_decode($response->getBody(), true);
    }
}
