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
        $this->date = $date ? $date : now();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!is_array($this->data)) {
            return;
        }

        try {
            $exception = $this->project->exceptions()->create($this->data);

            $exception->created_at = $this->date;
            $exception->save();

            $this->project->last_error_at = $this->date;
            $this->project->total_exceptions++;
            $this->project->save();
        } catch (\Exception $exception) {
        }

        if ($this->project->exceptions()->count(['id']) > 3000) {
            $this->project->exceptions()->orderBy('created_at', 'asc')->limit(1000)->delete();
        }
    }
}
