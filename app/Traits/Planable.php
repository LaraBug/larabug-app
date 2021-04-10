<?php

namespace App\Traits;

trait Planable
{
    public function canManageGroups()
    {
        return $this->plan->has_group_management;
    }

    public function canCreateProjects($projectCount = 0)
    {
        return $this->plan->max_projects != 0 && $projectCount >= $this->plan->max_projects;
    }
}
