<?php

namespace App\Models;

use Kblais\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class IssueEvent extends Model
{
    use Uuid;

    public $fillable = [
        'action',
        'causer',
        'content',
        'issue_id',
    ];

    public $eventActions = [
        'created' => 'Created',
        'github_issue_created' => 'GitHub issue created',
        'github_issue_closed' => 'GitHub issue closed',
        'github_issue_reopened' => 'GitHub issue reopened',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function getActionAttribute()
    {
        return \Arr::get($this->eventActions, $this->original['action']);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}