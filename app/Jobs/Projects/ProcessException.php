<?php

namespace App\Jobs\Projects;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessException implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $project;
    public $data;
    public $date;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param \App\Models\Project $project
     * @param \Illuminate\Support\Carbon $date
     */
    public function __construct(array $data, Project $project, $date = null)
    {
        $this->data = $data;
        $this->project = $project;
        $this->date = $date ?: now();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (! is_array($this->data)) {
            return;
        }

        try {
            $check = $this->project->exceptions()->where(function ($query) {
                return $query
                    ->where('exception', $this->data['exception'])
                    ->where('line', $this->data['line'])
                    ->whereNotNull('snooze_until')
                    ->where('snooze_until', '>', now());
            })->exists();

            if (! $check) {
                $exception = $this->project->exceptions()->create($this->data);

                $exception->created_at = $this->date;
                $exception->save();

                $issue = $this->project->issues()
                    ->firstOrCreate([
                        'exception' => $this->data['exception'],
                        'line' => $this->data['line'],
                    ], [
                        'exception_id' => $exception->id,
                    ]);

                $issue->update([
                    'last_occurred_at' => $this->date,
                    'status' => 'OPEN',
                ]);

                $exception->issue()->associate($issue)->save();

                $this->project->last_error_at = $this->date;
                $this->project->total_exceptions++;
                $this->project->save();
            }
        } catch (\Exception $exception) {
            // TODO: handle exception
        }

        if ($this->project->exceptions()->count(['id']) > 3000) {
            $this->project->exceptions()
                ->orderBy('created_at')
                ->limit(1000)
                ->delete();
        }
    }
}
