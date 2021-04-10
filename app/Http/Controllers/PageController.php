<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\Exception;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.welcome');
    }

    public function information()
    {
        return view('information');
    }

    public function requirements()
    {
        return view('requirements');
    }

    public function features()
    {
        return view('frontend.features');
    }

    public function explanation()
    {
        return view('explanation');
    }

    public function pricing()
    {
        return redirect()->route('larabug-is-free');
    }

    public function larabugIsFree()
    {
        $sponsors = Sponsor::all();

        return view('frontend.larabug-is-free', [
            'sponsors' => $sponsors
        ]);
    }

    public function exception($hash)
    {
        $exception = Exception::where('publish_hash', $hash)
            ->withCount('occurences')
            ->firstOrFail();

        return view('frontend.exception', compact('exception'));
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function policy()
    {
        return view('frontend.privacy-policy');
    }

    public function branding()
    {
        return view('frontend.branding');
    }
}
