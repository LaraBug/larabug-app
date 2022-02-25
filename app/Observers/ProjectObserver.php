<?php

namespace App\Observers;

class ProjectObserver
{
    public function updated()
    {
        // If there is a GitHub repo linked, check if there is a webhook
    }

    public function deleted()
    {
        // Remove the LaraBug if a GitHub repo is linked webhook
    }
}