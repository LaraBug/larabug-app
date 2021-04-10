<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Exception;
use Illuminate\Support\Facades\Mail;

class FeedbackApiHttpTest extends TestCase
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
    public function it_adds_feedback_to_an_exception()
    {
        $exception = factory(Exception::class)->create([
            'project_id' => $this->project->id
        ]);

        $this->withoutExceptionHandling();

        $this->post(route('api.feedback'), [
            'id' => $exception->id,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'feedback' => $this->faker->sentence
        ])->assertOk();
    }
}
