<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ConvertUserProjectDataToPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * This seeder was used to convert the user_id in projects to the pivot table itself.
         * It is not required anymore.
         */

        return;

        $projects = \App\Models\Project::whereNotNull('user_id')->get();

        $projects->each(function ($project) {
            $user = \App\Models\User::findOrFail($project->user_id);

            $project->users()->save($user, ['owner' => true]);

            $project->user_id = null;

            $project->save();
        });

        Schema::table('projects', function ($table) {
            $table->dropForeign('projects_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
