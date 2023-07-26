<?php

namespace App\Http\Controllers;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\PersonalAccessTokenFactory;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Token;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'CheckDev']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pageinfo = [
            'title' => __('Profile'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',

        ];
        return view('home', compact('pageinfo'));
    }
}
