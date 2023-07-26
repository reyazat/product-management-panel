<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Helpers\api\v1\AuthHelper;
use App\Http\Helpers\Helpers;
use App\Http\Requests\api\v1\FirstRequest;
use App\Http\Requests\api\v1\StoreAuthRequest;
use App\Jobs\PurgeCode;
use App\Jobs\sendSms;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $helper;
    public function __construct(AuthHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @OA\Post(
     * path="/api/v1/first",
     * tags={"Authentication"},
     * summary="مرحله اول ثبت نام با شماره موبایل",
     * description="در این مرحله یوزر با تایید شماره موبایل ثبت نام و فعال می شود",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               required={"mobile","terms"},
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="terms", type="boolean"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="یک کد تایید جدید به موبایل شما ارسال شد",
     *          @OA\JsonContent(
     *             @OA\Examples(
     *                summary="ثبت نام جدید",
     *                example = "ثبت نام جدید",
     *                value = {
     *                   "status": "success",
     *                   "code": 200,
     *                      "message": "یک کد تایید جدید به موبایل شما ارسال شد.",
     *                   "errors": {},
     *                   "data": {"expires_in": 120}
     *                },
     *              )
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="رکورد تکراری",
     *           @OA\JsonContent(
     *              @OA\Examples(
     *                  summary="اعتبار سنجی درخواست",
     *                  example = "اعتبار سنجی درخواست",
     *                  value = {
     *                      "status": "error",
     *                      "code": 422,
     *                      "message": "شماره همراه قبلا انتخاب شده است.",
     *                      "errors": {
     *                          "mobile": {
     *                              "شماره همراه قبلا انتخاب شده است."
     *                          }
     *                       },
     *                      "data": {}
     *                  },
     *              )
     *          )
     *       ),
     * )
     */

    public function first(FirstRequest $request)
    {
        $validate = $request->validated();

        $code = $this->helper->generateUniqueCode();
        try {
            $user = $this->helper->store($request->all(), (int) $code);
            $dateTime = Carbon::now();
            sendSms::dispatch([(string) $code], (string) $request['mobile'], 29420);
            PurgeCode::dispatch($user)->delay($dateTime->addMinutes(3));
            return Helpers::setResponse([
                'message' => __("A fresh verification code has been sent to your mobile."),
                'status' => 'success',
                'code' => 200,
                "data" => ["expires_in" => 120,],
            ]);
        } catch (QueryException $e) {

            return Helpers::setResponse([
                'message' => $e->getMessage(),
                'status' => 'error',
                'code' => 422,
                'errors' => $e->errorInfo
            ]);
        }
    }

    /**
     * @OA\Post(
     * path="/api/v1/verify",
     * tags={"Authentication"},
     * summary="تایید شماره موبایل با کد ارسالی",
     * description="در این مرحله کد تاییدی که دریافت کرده اید را برای تایید شماره موبایل ارسال کنید",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               required={"code","mobile"},
     *               @OA\Property(property="code", type="integer"),
     *               @OA\Property(property="mobile", type="string"),
     *            ),
     *        ),
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="تایید حساب کاربری",
     *          @OA\JsonContent(
     *             @OA\Examples(
     *                summary="اعتبار سنجی شماره موبایل",
     *                example ="اعتبار سنجی شماره موبایل",
     *                value = {
     *                   "status": "success",
     *                   "code": 200,
     *                   "message": "",
     *                   "errors": {},
     *                   "data": {
     *                          "token_type": "Bearer",
     *                          "expires_in": "2024-06-22 19:13:19",
     *                          "accessToken": "eyJ0eXAiOiJKV1Q......"
     *                          "user":{
     *                              id: null,
     *                          }
     *                      }
     *                },
     *              )
     *          )
     *       ),
     * *      @OA\Response(
     *          response=404,
     *          description="تایید حساب کاربری",
     *          @OA\JsonContent(
     *             @OA\Examples(
     *                summary="اعتبار سنجی شماره موبایل",
     *                example ="اعتبار سنجی شماره موبایل",
     *                value = {
     *                   "status": "error",
     *                   "code": 404,
     *                   "message": "کد وارد شده نادرست می باشد",
     *                   "errors": {},
     *                   "data": {}
     *                },
     *              )
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="تایید حساب کاربری",
     *           @OA\JsonContent(
     *           @OA\Examples(
     *                summary="اعتبار سنجی شماره موبایل",
     *                example ="اعتبار سنجی شماره موبایل",
     *                value = {
     *                "status": "error",
     *                "code": 422,
     *                "message": "فیلد code الزامی است.",
     *                "errors": {
     *                    "code": {
     *                      "فیلد code الزامی است."
     *                      }
     *                  },
     *                "data": {}
     *             },
     *          )
     *         )
     *       ),
     * )
     */
    public function doVerify(Request $request)
    {
        try {
            $this->validate($request, ['mobile' => 'required|min:11|max:11|regex:/^09[0-9]{9}$/','code' => 'required|integer']);
        } catch (ValidationException $e) {
            return Helpers::setResponse([
                'message' => $e->getMessage(),
                'status' => 'error',
                'code' => 422,
                'errors' => $e->errors()

            ]);
        }

        try {
            return Helpers::setResponse($this->helper->verifyCode($request->all()));
        } catch (\Exception $e) {
            return Helpers::setResponse([
                'message' => $e->getMessage(),
                'status' => 'error',
                'code' => ($e->getCode() != 0)?$e->getCode():400
            ]);
        }
    }
    /**
     * @OA\Get(
     * path="/api/v1/verify",
     * tags={"Authentication"},
     * summary="اطلاع از اخرین وضعیت حساب کاربری",
     * description="با ارسال شماره موبایل از اخرین وضعیت حساب کاربری مطلع شوید",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               required={"mobile"},
     *               @OA\Property(property="mobile", type="string"),
     *            ),
     *        ),
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="استعلام وضعیت حساب کاربری",
     *          @OA\JsonContent(
     *             @OA\Examples(
     *                summary="استعلام وضعیت حساب کاربری",
     *                example ="استعلام وضعیت حساب کاربری",
     *                value = {
     *                   "status": "success",
     *                   "code": 200,
     *                   "message": "حساب کاربری شما قبلا فعال شده است",
     *                   "errors": {},
     *                   "data": {}
     *                },
     *              )
     *          )
     *       ),
     * *      @OA\Response(
     *          response=404,
     *          description="استعلام وضعیت حساب کاربری",
     *          @OA\JsonContent(
     *             @OA\Examples(
     *                summary="استعلام وضعیت حساب کاربری",
     *                example ="استعلام وضعیت حساب کاربری",
     *                value = {
     *                   "status": "error",
     *                   "code": 404,
     *                   "message": "خطایی به وجود آمده است - چنین کاربری در سیستم وجود ندارد",
     *                   "errors": {},
     *                   "data": {}
     *                },
     *              )
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="استعلام وضعیت حساب کاربری",
     *           @OA\JsonContent(
     *           @OA\Examples(
     *                summary="استعلام وضعیت حساب کاربری",
     *                example ="استعلام وضعیت حساب کاربری",
     *                value = {
     *                "status": "error",
     *                "code": 422,
     *                "message": "فیلد شماره همراه الزامی است.",
     *                "errors": {
     *                    "mobile": {
     *                      "فیلد شماره همراه الزامی است."
     *                      }
     *                  },
     *                "data": {}
     *             },
     *          )
     *         )
     *       ),
     * )
     */

    public function getVerify(Request $request)
    {
        try {
            $this->validate($request, ['mobile' => 'required|min:11|max:11|regex:/^09[0-9]{9}$/',]);
        } catch (ValidationException $e) {
            return Helpers::setResponse([
                'message' => $e->getMessage(),
                'status' => 'error',
                'code' => 422,
                'errors' => $e->errors()

            ]);
        }
        try {
            return Helpers::setResponse($this->helper->getVerify($request->input('mobile')));
        } catch (\Exception $e) {
            return Helpers::setResponse([
                'message' => $e->getMessage(),
                'status' => 'error',
                'code' => ($e->getCode() != 0)?$e->getCode():400
            ]);
        }
    }


    public function register(StoreAuthRequest $request)
    {
        $validate = $request->validated();

        return response()->json($validate);
    }

    /**
     * @OA\Post(
     * path="/api/v1/login",
     * tags={"Authentication"},
     * summary="ورود به حساب کاربری با موبایل",
     * description="ورود به حساب کاربری با موبایل",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               required={"mobile"},
     *               @OA\Property(property="mobile", type="string"),
     *            ),
     *        ),
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="ورود به حساب کاربری با موبایل",
     *          @OA\JsonContent(
     *             @OA\Examples(
     *                summary="ورود به حساب کاربری با موبایل",
     *                example ="ورود به حساب کاربری با موبایل",
      *                value = {
     *                   "status": "success",
     *                   "code": 200,
     *                      "message": "یک کد تایید جدید به موبایل شما ارسال شد.",
     *                   "errors": {},
     *                   "data": {"expires_in": 120}
     *                },
     *              )
     *          )
     *       ),
     * *      @OA\Response(
     *          response=404,
     *          description="استعلام وضعیت حساب کاربری",
     *          @OA\JsonContent(
     *             @OA\Examples(
     *                summary="استعلام وضعیت حساب کاربری",
     *                example ="استعلام وضعیت حساب کاربری",
     *                value = {
     *                   "status": "error",
     *                   "code": 404,
     *                   "message": "چنین کاربری در سیستم وجود ندارد یا حساب کاربری هنوز فعال نشده است",
     *                   "errors": {},
     *                   "data": {}
     *                },
     *              )
     *          )
     *       ),
     * )
     */

    public function login(Request $request)
    {
        try {
            $this->validate($request, ['mobile' => 'required|min:11|max:11|regex:/^09[0-9]{9}$/']);
        } catch (ValidationException $e) {
            return Helpers::setResponse([
                'message' => $e->getMessage(),
                'status' => 'error',
                'code' => 422,
                'errors' => $e->errors()

            ]);
        }
        $code = $this->helper->generateUniqueCode();
        try {
            $user = $this->helper->login($request->input('mobile'), (int) $code);
            $dateTime = Carbon::now();
            sendSms::dispatch([(string) $code], (string) $request['mobile'], 29420);
            PurgeCode::dispatch($user)->delay($dateTime->addMinutes(3));
            return Helpers::setResponse([
                'message' => __("A fresh verification code has been sent to your mobile."),
                'status' => 'success',
                'code' => 200,
                "data" => ["expires_in" => 120,],
            ]);
        } catch (QueryException $e) {
            return Helpers::setResponse([
                'message' => $e->getMessage(),
                'status' => 'error',
                'code' => 422,
                'errors' => $e->errorInfo
            ]);
        }catch (\Exception $e) {
            return Helpers::setResponse([
                'message' => $e->getMessage(),
                'status' => 'error',
                'code' => ($e->getCode() != 0)?$e->getCode():400
            ]);
        }

    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response('Successfully logged out', 200);
    }


}
