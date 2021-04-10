<?php

namespace App\Http\Controllers\Profile;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        return inertia('Profile/Index', [
            'user' => auth()->user(),
            'settings' => auth()->user()->settings,
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'max:190',
                Rule::unique('users')->ignore(auth()->user()->id)
            ],
        ]);

        $request->user()->update($request->all());

        return redirect()->route('panel.profile.show')->with('success', 'Profile updated');
    }

    public function settings(Request $request)
    {
        $request->user()->update([
            'settings' => $request->input('settings'),
            'newsletter' => $request->input('newsletter', true),
        ]);

        return redirect()->route('panel.profile.show')->with('success', 'Profile settings updated');
    }
}
