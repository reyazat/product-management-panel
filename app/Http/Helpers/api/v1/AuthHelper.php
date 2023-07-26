<?php

namespace App\Http\Helpers\api\v1;

use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;

class AuthHelper
{

    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (User::where("code", "=", $code)->first());

        return $code;
    }

    public function verifyCode($data)
    {
        $user = User::where("code", "=", $data['code'])->where("mobile", "=", $data['mobile'])->with('customergroups')->first();
        if ($user) {
            $user->status = true;
            $user->code = null;
            $user->forceFill(['mobile_verified_at' => now(),]);
            $user->save();

            $token =   $user->createToken($user->email);

            return  [
                "code" => 200,
                'status' => 'success',
                'data' => [
                    "token_type" => "Bearer",
                    "expires_in" => Carbon::parse($token->token->expires_at)->toDateTimeString(),
                    'accessToken' => $token->accessToken,
                    'user' => $user->toArray()
                ]
            ];
        } else
            throw new Exception(message: "کد وارد شده نادرست می باشد یا چنین کاربری در سیستم وجود ندارد", code: 404);
    }

    public function getVerify($mobile)
    {
        $user = User::where("mobile", "=", $mobile)->first();
        if ($user) {
            if ($user->status == false)
                return  [
                    "message" => "حساب کاربری فعال نشده است",
                    "code" => 401,
                    'status' => 'error',
                ];
            else
                return  [
                    "message" => "حساب کاربری شما قبلا فعال شده است",
                    "code" => 200,
                    'status' => 'success',
                ];
        } else
            throw new Exception(message: "خطایی به وجود آمده است - چنین کاربری در سیستم وجود ندارد", code: 404);
    }

    public function store(array $data, $code)
    {
        $store = new User();
        $store->mobile = $data['mobile'];
        $store->terms = $data['terms'];
        $store->code = $code;
        $store->role = 'User';
        $store->status = 0;
        $store->save();

        return $store;
    }

    public function login($mobile, $code)
    {
        $user = User::where("mobile", "=", $mobile)->where('status', '=', 1)->first();
        if ($user){
            $user->update(['code'=>$code]);
        }
        else throw new Exception(message: "چنین کاربری در سیستم وجود ندارد یا حساب کاربری هنوز فعال نشده است", code: 404);
        return $user;
    }
}
