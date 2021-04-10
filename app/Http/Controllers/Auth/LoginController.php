<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\SocialUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Honeypot\ProtectAgainstSpam;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/panel';

    protected $supportedProviders = [
        'github',
        'ploi'
    ];

    public function showLoginForm()
    {
        return view('frontend.login');
    }

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->middleware(ProtectAgainstSpam::class)->only('login');
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response('', 409)->header('x-inertia-location', '/');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param string $provider
     *
     * @return Response
     */
    public function redirectToProvider($provider = 'facebook')
    {
        if (!in_array($provider, $this->supportedProviders)) {
            return redirect()->route('login')->withErrors([
                'provider' => 'This provider (' . $provider . ') is not supported.'
            ]);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param string $provider
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request, $provider = 'facebook')
    {
        /* @var $driver \Laravel\Socialite\Contracts\Provider */
        $driver = Socialite::driver($provider);

        try {
            /* @var $social \Laravel\Socialite\AbstractUser */
            $social = $driver->user();
        } catch (\Exception $e) {
            return redirect()->route('home');
        }

        /* @var $socialUser \App\Models\SocialUser */
        $socialUser = SocialUser::where('provider_id', $social->getId())
            ->where('provider', $provider)
            ->first();

        /* @var $user \App\Models\User */
        if ($socialUser) {
            $user = $socialUser->user;

            if ($request->user() && $socialUser->user_id != $request->user()->id) {
                return redirect()->route('login')->withErrors([
                    'provider' => 'This ' . $provider . ' provider is already linked to another account.'
                ]);
            }
        } elseif ($request->user()) {
            $user = $request->user();
        } else {
            if (!$social->getEmail()) {
                return redirect()->route('login')->withErrors([
                    'provider' => 'We did not receive a e-mail address to log you in with, please evaluate your login from the third party.'
                ]);
            }

            $user = User::where('email', $social->getEmail())
                ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $social->getName(),
                    'email' => $social->getEmail(),
                    'password' => str_random()
                ]);
            }
        }

        if (!$socialUser) {
            $socialUser = $user->social_users()->create([
                'provider' => $provider,
                'provider_id' => $social->getId(),
            ]);
        }

        if (!auth()->check()) {
            auth()->guard()->login($user);
        }

        return $this->sendLoginResponse($request);
    }
}
