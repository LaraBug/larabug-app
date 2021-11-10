<?php

use App\Models\Exception;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use function Pest\Laravel\post;
use function Pest\Laravel\withoutExceptionHandling;

beforeEach(function () {
    Mail::fake();
    $this->project = Project::factory()->create();
    $this->user = User::factory()->create();
    $this->user->projects()->save($this->project, ['owner' => true]);
});

it('adds feedback to an exception', function () {
    $exception = Exception::factory()->create([
        'project_id' => $this->project->id,
    ]);

    withoutExceptionHandling();

    post(route('api.feedback'), [
        'id' => $exception->id,
        'name' => $this->faker->name,
        'email' => $this->faker->email,
        'feedback' => $this->faker->sentence,
    ])->assertOk();
});

