<?php

namespace App\Http\Controllers;

use App\Models\Exception;
use App\Http\Requests\GroupRequest;

/**
 * Class GroupController
 *
 * @package App\Http\Controllers
 */
class GroupController extends Controller
{
    /**
     * GroupController constructor.
     */
    public function __construct()
    {
        $this->middleware('group.management');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $groups = auth()->user()
            ->projectGroups()
            ->with(['projects' => function ($query) {
                return $query->select('id', 'group_id', 'title');
            }])
            ->latest()
            ->paginate();

        return view('groups.index', compact('groups'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GroupRequest $request)
    {
        $request->user()->projectGroups()->create($request->all());

        return redirect()->route('groups.index');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $group = auth()->user()
            ->projectGroups()
            ->findOrFail($id);

        return view('groups.edit', compact('group'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return mixed
     */
    public function update(GroupRequest $request, $id)
    {
        $group = $request->user()
            ->projectGroups()
            ->findOrFail($id);

        $group->update($request->all());

        return redirect()->route('groups.show', $group)->withSuccess('Group has been modified!');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $group = auth()->user()
            ->projectGroups()
            ->with(['projects' => function ($query) {
                $query->latest('last_error_at')
                    ->with(['exceptions' => function ($query) {
                        return $query->where(function ($query) {
                            return $query
                                ->whereStatus(Exception::OPEN)// ## Where exceptions are open
                                ->orWhereNull('status'); // ## Where status is null (for some reason..)
                        })
                            ->select('id', 'status', 'project_id', 'created_at');
                    }]);
            }])
            ->findOrFail($id);

        return view('groups.show', compact('group'));
    }

    /**
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $group = auth()->user()
            ->projectGroups()
            ->findOrFail($id);

        if ($group->projects->count()) {
            return redirect()->back()->withErrors([
                'This group still contains projects, please remove the projects from this group.'
            ]);
        }

        $group->delete();

        return redirect()->route('groups.index');
    }
}
