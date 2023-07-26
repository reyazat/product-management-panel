<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);
    }
    public function showLoginForm()
    {
        $payload = [
            'pageinfo' => [
                'title' => 'title',
                'description' => 'description',
                'keywords' => 'keywords',
                'owner' => 'owner'
            ]
        ];
        return view('panel.auth.login',$payload);
    }

    public function authenticated(Request $request, $user){

        if($user->role == 'Admin'){
            return redirect(RouteServiceProvider::PANEL);
        }else{
            return redirect(RouteServiceProvider::HOME);

        }
    }
}
