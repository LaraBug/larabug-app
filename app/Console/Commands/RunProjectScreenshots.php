<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use App\Jobs\Projects\GetSiteScreenshot;

class RunProjectScreenshots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:screenshots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab a screenshot from the project\'s website for awesomeness.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $projects = Project::whereNotNull('url')->where('url', '!=', '')->get();

        foreach ($projects as $project) {
            dispatch(new GetSiteScreenshot($project));
        }
    }
}
