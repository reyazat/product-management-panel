<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        $payload = [
            'pageinfo' => [
                'title' => 'title',
                'description' => 'description',
                'keywords' => 'keywords',
                'owner' => 'owner'
            ]
        ];
        return view('panel.auth.passwords.email',$payload);
    }

}
