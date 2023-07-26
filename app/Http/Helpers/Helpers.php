<?php

namespace App\Http\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

class Helpers
{
    public static function isValidNationalCode($nationalCode)
    {
        if (empty($nationalCode)) {
            return false;
        }

        if (strlen($nationalCode) != 10) {
            return false;
        }

        $regex = '/\d{10}/';
        if (!preg_match($regex, $nationalCode)) {
            return false;
        }

        $allDigitEqual = ['0000000000', '1111111111', '2222222222', '3333333333', '4444444444', '5555555555', '6666666666', '7777777777', '8888888888', '9999999999'];
        if (in_array($nationalCode, $allDigitEqual)) {
            return false;
        }

        $chArray = str_split($nationalCode);
        $num0 = intval($chArray[0]) * 10;
        $num2 = intval($chArray[1]) * 9;
        $num3 = intval($chArray[2]) * 8;
        $num4 = intval($chArray[3]) * 7;
        $num5 = intval($chArray[4]) * 6;
        $num6 = intval($chArray[5]) * 5;
        $num7 = intval($chArray[6]) * 4;
        $num8 = intval($chArray[7]) * 3;
        $num9 = intval($chArray[8]) * 2;
        $a = intval($chArray[9]);

        $b = (((((((($num0 + $num2) + $num3) + $num4) + $num5) + $num6) + $num7) + $num8) + $num9);
        $c = $b % 11;

        return (($c < 2) && ($a == $c)) || (($c >= 2) && ((11 - $c) == $a));
    }


    public static function sendSms(array $text, string $to, int $bodyId)
    {
        $url = 'https://console.melipayamak.com/api/send/shared/d2e9ef82b51d4d7ca905858e5888851c';
        $data = array('bodyId' => $bodyId, 'to' => $to, 'args' => $text);
        $data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );
        $result = curl_exec($ch);
        $result = json_decode($result);
        curl_close($ch);
        if (curl_errno($ch)) {
            abort(400, curl_error($ch));
        }
        Log::info('sendSms Job', array('context' => $result));
    }


    public static function setResponse($params = [])
    {

        $msg['status'] = (isset($params['status'])) ? $params['status'] : '';
        $msg['code'] = (isset($params['code'])) ? $params['code'] : 400;
        $msg['message'] = (isset($params['message'])) ? $params['message'] : '';
        $msg['errors'] = (isset($params['errors'])) ? $params['errors'] : new class{};

        $msg['data'] = (isset($params['data'])) ? $params['data'] : new class{};

        return response()->json($msg , $msg['code']);
    }
}
