<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Exception;
use Illuminate\Http\Request;

class ExceptionController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = auth()->user()->projects()->findOrFail($id, [
            'id',
            'title'
        ]);

        $exceptions = $project
            ->exceptions();

        if (!$request->input('status')) {
            $exceptions = $exceptions->whereNotIn('status', [
                'DONE',
                'FIXED'
            ]);
        } else {
            $exceptions = $exceptions->filter($request->all());
        }

        $exceptions = $exceptions
            ->latest()
            ->paginateFilter(15, [
                'id',
                'status',
                'exception',
                'project_id',
                'publish_hash',
                'created_at',
                'method',
                'class',
                'line',
                'fullUrl',
                'file'
            ]);

        if ($request->ajax()) {
            return $exceptions;
        }

        return view('exceptions.index', compact('project', 'exceptions'));
    }

    public function show($id, $exception)
    {
        $project = auth()->user()->projects()->findOrFail($id);

        /* @var $exception Exception */
        $exception = $project->exceptions()
            ->with('feedback')
            ->withCount('occurences')
            ->findOrFail($exception);

        /*
         * Mark exception as read
         */
        if (!$exception->status || $exception->status == Exception::OPEN) {
            $exception->markAsRead();
        }

        // If it was not mailed yet (delay in cronjob which is ok), then mark as e-mail, saves resources & emails :)
        if (!$exception->isMarkedAsMailed()) {
            $exception->markAsMailed();
        }

        return inertia('Exceptions/Show', [
            'project' => $project,
            'exception' => $exception
        ]);
    }

    public function destroy($id, $exception)
    {
        $project = auth()->user()->projects()->findOrFail($id);

        $exception = $project->exceptions()->findOrFail($exception);

        $exception->delete();

        /*
         * Return redirect back to save filter
         */
        return redirect()->back();
    }

    public function fixed($id, $exception)
    {
        $project = auth()->user()->projects()->findOrFail($id);

        $exception = $project->exceptions()->findOrFail($exception);

        $exception->markAs(Exception::FIXED);

        /*
         * Also mark as mailed because the user would already know about this exception
         */
        $exception->markAsMailed();

        /*
         * Return redirect back to save filter
         */
        return redirect()->route('panel.exceptions.show', [$id, $exception])->with('success', 'Exception has been marked as fixed');
    }

    public function togglePublic(Request $request, $id, $exception)
    {
        $project = $request->user()->projects()->findOrFail($id);

        $exception = $project->exceptions()->findOrFail($exception);

        if ($exception->publish_hash) {
            $exception->removePublic();

            return redirect()->back()->withSuccess('Exception has been removed from public view');
        }

        $exception->makePublic();

        return redirect()->back()->withSuccess('URL has been generated');
    }

    public function markAllAsFixed(Request $request, $id)
    {
        $project = $request->user()->projects()->findOrFail($id);

        $total = $project->exceptions()
            ->where('status', '!=', Exception::FIXED)
            ->update(['status' => Exception::FIXED]);

        if ($total == 0) {
            return redirect()->route('panel.projects.show', $id)->with('info', 'There are no exceptions to mark as fixed');
        }

        return redirect()->route('panel.projects.show', $id)->with('success', $total . ' exception(s) have been marked as fixed');
    }

    public function markAllAsRead(Request $request, $id)
    {
        $project = $request->user()->projects()->findOrFail($id);

        $total = $project->exceptions()
            ->where('status', '!=', Exception::READ)
            ->where('status', '!=', Exception::FIXED)
            ->update(['status' => Exception::READ]);

        if ($total == 0) {
            return redirect()->route('panel.projects.show', $id)->with('info', 'There are no exceptions to mark as read');
        }


        return redirect()->route('panel.projects.show', $id)->with('success', $total . ' exception(s) have been marked as read');
    }

    public function markAs(Request $request, $id)
    {
        $project = $request->user()->projects()->findOrFail($id);

        foreach ($request->input('exceptions') as $exception) {
            $exception = $project->exceptions()->findOrFail($exception);

            if (strtoupper($request->input('type')) == 'FIXED') {
                $exception->markAs(Exception::FIXED);

                /*
                 * Also mark as mailed because the user would already know about this exception
                 */
                $exception->markAsMailed();
            } else {
                $exception->markAs(Exception::READ);
            }
        }

        return redirect()->back();
    }

    public function deleteAll(Request $request, $id)
    {
        $project = $request->user()->projects()->findOrFail($id);

        $project->exceptions()->delete();

        return redirect()->route('panel.projects.show', $id)->with('success', 'All exceptions have been cleared up');
    }
}
