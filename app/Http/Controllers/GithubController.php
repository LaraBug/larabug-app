<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GithubController extends Controller
{
    public function link()
    {
        $params = [
            'client_id' => env('GITHUB_OAUTH_ID'),
            'scope' => 'repo',
            'redirect_uri' => env('GITHUB_OAUTH_REDIRECT_URL'),
        ];

        return redirect('https://github.com/login/oauth/authorize?' . http_build_query($params));
    }

    public function callback(Request $request)
    {
        $code = $request->code;

        //
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post('https://github.com/login/oauth/access_token', [
            'client_id' => env('GITHUB_OAUTH_ID'),
            'client_secret' => env('GITHUB_OAUTH_SECRET'),
            'code' => $code,
            'redirect_uri' => env('GITHUB_OAUTH_REDIRECT_URL'),
        ]);

        $json = $response->json();

        //
        $user = auth()->user();

        $user->github_access_token = $json['access_token'];

        $user->save();

        return redirect()->route('panel.profile.show')->with('success', 'Github linked!');
    }
}