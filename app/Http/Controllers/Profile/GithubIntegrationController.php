<?php

namespace App\Http\Controllers\Profile;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class GithubIntegrationController extends Controller
{
    public function link()
    {
        session()->put('linking_github', 'true');

        return Inertia::location(Socialite::driver('github')
            ->setScopes(config("services.github.scopes", []))
            ->redirect()->getTargetUrl());
    }

    public function unlink()
    {
        //
        $socialUser = auth()->user()->social_users()->firstWhere('provider', 'github');

        if ($socialUser) {
            $socialUser->delete();
        }

        return redirect()
            ->route('panel.profile.show')
            ->with('success', 'GitHub account unlinked!');
    }

    public function webhook(Request $request)
    {
        ray($request->all());

        return redirect()->route('panel.profile.show')->with('success', 'GitHub account linked!');
    }
}