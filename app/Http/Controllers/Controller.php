<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Product Management Panel",
 *      description="Product Management Panel",
 *      @OA\Contact(
 *          email="info@khaneh-mobile.ir"
 *      ),
 *      @OA\License(
 *          name="",
 *          url=""
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
