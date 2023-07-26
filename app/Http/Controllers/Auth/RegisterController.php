<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'min:11'],
            'password' => ['required', 'min:8', 'confirmed'],
            'terms_and_conditions' => 'accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user = new User();
        $user->fullname = $data['name'] . ' ' . $data['surname'];
        $user->email = $data['email'];
        $user->mobile = $data['mobile'];
        $user->password = Hash::make($data['password']);
        $user->role = 'Dev';
        $user->status = 1;
        $user->terms = $data['terms_and_conditions'];
        $user->save();

        $token = $user->createToken($data['email'])->accessToken;
        $user->forceFill(['accesstoken' => $token])->save();
        return $user;

    }

    public function showRegistrationForm()
    {
        $payload = [
            'pageinfo' => [
                'title' => 'title',
                'description' => 'description',
                'keywords' => 'keywords',
                'owner' => 'owner'
            ]
        ];
        return view('panel.auth.register', $payload);
    }
}
