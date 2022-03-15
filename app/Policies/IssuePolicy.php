<?php

namespace App\Policies;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IssuePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Issue $issue): bool
    {
        return $this->hasAccessToIssue($user, $issue);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Issue $issue): bool
    {
        return $this->hasAccessToIssue($user, $issue);
    }

    public function delete(User $user, Issue $issue): bool
    {
        return $this->hasAccessToIssue($user, $issue);
    }

    public function restore(User $user, Issue $issue): bool
    {
        return $this->hasAccessToIssue($user, $issue);
    }

    public function forceDelete(User $user, Issue $issue): bool
    {
        return $this->hasAccessToIssue($user, $issue);
    }

    private function hasAccessToIssue(User $user, Issue $issue): bool
    {
        return $issue->project->users->contains($user);
    }
}
