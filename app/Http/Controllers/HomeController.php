<?php

namespace App\Http\Controllers;

use App\Models\Exception;

class HomeController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()->get(['id'])->pluck('id')->toArray();

        $exceptions = Exception::whereIn('project_id', $projects)
            ->with('project:id,title')
            ->latest('created_at')
            ->limit(8)
            ->get([
                'id',
                'status',
                'class',
                'fullUrl',
                'method',
                'file',
                'file_type',
                'line',
                'project_id',
                'exception',
                'created_at',
            ]);

        $totalExceptions = auth()->user()->projects()->sum('total_exceptions');
        $totalProjects = auth()->user()->projects()->count();

        $exceptionChart = Exception::whereIn('project_id', $projects)
            ->where('created_at', '>', now()->subDays(7))
            ->oldest()
            ->select(['created_at'])
            ->get()
            ->groupBy(function ($exception) {
                return $exception->created_at->format('Y-m-d');
            })->map(function ($exceptions) {
                return $exceptions->count();
            });


        return inertia('Dashboard', [
            'exceptions' => $exceptions,
            'exceptionChart' => $exceptionChart,
            'totalExceptions' => $totalExceptions,
            'totalProjects' => $totalProjects
        ]);
    }

    public function introduction()
    {
        return inertia('Dashboard/Introduction');
    }
}
