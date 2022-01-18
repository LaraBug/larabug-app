<?php namespace App\Utilities;

use Github\Client;
use App\Models\User;

class GithubIssues
{
    protected User $user;

    protected string $repoUser;

    protected string $repoRepo;

    public Client $client;

    public function __construct($user, $repo)
    {
        $this->user = $user;

        //
        $expl = explode('/', $repo);
        $this->repoUser = $expl[0];
        $this->repoRepo = $expl[1];

        //
        $this->client = new Client();

        //
        $this->client->authenticate($this->user->github_access_token, null, \Github\AuthMethod::ACCESS_TOKEN);
    }

    public function create($title, $body)
    {
        return $this->client->api('issue')->create($this->repoUser, $this->repoRepo, [
            'title' => $title,
            'body' => $body,
        ]);
    }

    public function createWebhook()
    {
        return $this->client->api('repo')->hooks()->create($this->repoUser, $this->repoRepo, [
            'owner' => $this->repoUser,
            'repo' => $this->repoRepo,
            'name' => 'web',
            'config' => [
                'url' => url('github-webhook'),
                'content_type' => 'json',
                'secret' => 'abc123',
                'insecure_ssl' => 1,
            ],
            'events' => ['*'],
        ]);
    }

    public static function make($user, $repo)
    {
        return new static($user, $repo);
    }
}