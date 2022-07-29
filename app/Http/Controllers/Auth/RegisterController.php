<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Models\User;
use App\Traits\Captcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Spatie\Honeypot\ProtectAgainstSpam;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, Captcha;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/panel';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware(ProtectAgainstSpam::class)->only('register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->uncompromised()
            ]
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

//        if ($this->captchaCheck($request) == false) {
//            return redirect()->back()
//                ->withErrors(['captcha' => 'You did not validate the captcha correctly.'])
//                ->withInput();
//        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }


    public function showRegistrationForm()
    {
        return view('frontend.register');
    }
}
