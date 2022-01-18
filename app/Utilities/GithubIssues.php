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
        try {
            $this->client->authenticate($this->user->github_access_token, null, \Github\AuthMethod::ACCESS_TOKEN);
        } catch(\Exception $ex) {
            ray()->exception($ex);
        }

        ray($this->client);
    }

    public function create($title, $body)
    {
        try {
            $response = $this->client->api('issue')->create($this->repoUser, $this->repoRepo, [
                'title' => $title,
                'body' => $body,
            ]);
        } catch (\Exception $exception) {
            ray()->exception($exception);
        }

        return $response;
    }

    public static function make($user, $repo)
    {
        return new static($user, $repo);
    }
}