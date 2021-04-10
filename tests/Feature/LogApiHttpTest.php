<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;

class LogApiHttpTest extends TestCase
{
    private $project;
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        $this->project = factory(Project::class)->create();
        $this->user = factory(User::class)->create();
        $this->user->projects()->save($this->project, ['owner' => true]);
    }

    /** @test */
    public function it_logs_an_exception()
    {
        $this->assertCount(0, $this->project->exceptions);

        $this->be($this->user, 'api')->post(route('exceptions.log'), [
            'project' => $this->project->key,
            'exception' => [
                'exception' => 'Whoops something seems to have gone wrong..'
            ]
        ])->assertOk();

        $this->assertCount(1, $this->project->fresh()->exceptions);
    }
}
