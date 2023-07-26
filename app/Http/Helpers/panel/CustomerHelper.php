<?php

namespace App\Http\Helpers\panel;

use App\Http\Helpers\Helpers;
use App\Models\User;
use App\Notifications\panel\PasswordSent;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CustomerHelper
{
    protected $redirectRoute  = 'customer.panel';

    /**
     * Get active customers.
     * @return \App\Models\User|null
     */
    public function activeUsers()
    {

        return User::select(['id', 'fullname', 'company', 'email', 'email_verified_at', 'mobile', 'mobile_verified_at', 'Identity', 'phone', 'file', 'role', 'type'])
            ->where('role', '=', 'User')
            ->where('status', '=', '1')
            ->orderByDesc('id')->get();
    }
    /**
     * Get inactive customers.
     * @return \App\Models\User|null
     */
    public function inactiveUsers()
    {

        return User::select(['id', 'fullname', 'company', 'email', 'email_verified_at', 'mobile', 'mobile_verified_at', 'Identity', 'phone', 'file', 'role', 'type'])
            ->where('role', '=', 'User')
            ->where('status', '<>', '1')
            ->orderByDesc('id')->get();
    }
    /**
     * Delete selected customers.
     * @return \App\Models\User|null
     */
    public function deleteAll($ids)
    {
        return User::whereIn('id', explode(',', $ids))->delete();
    }

    /**
     * Validate user by real type
     * @param Request $request
     * @return array $validate
     */
    public function realValidator(Request $request)
    {
        $rules = [
            'personaluserid' => ['nullable', 'integer'],
            'personalfullname' => ['required', 'string', 'max:255'],
            'personalidentity' => ['required', 'max:10', function (string $attribute, mixed $value, Closure $fail) {
                if (!Helpers::isValidNationalCode($value)) {
                    $fail(__('کد ملی وارد شده معتبر نمی باشد'));
                }
            },],
            'personalmobile' => ['required', 'min:11', Rule::unique('users', 'mobile')->ignore($request->input('personaluserid'))],
            'personalphone' => ['nullable', 'numeric', 'min:11'],
            'personalemail' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($request->input('personaluserid'))],
            'personalpostcode' => ['nullable', 'min:10', 'max:10'],
            'personaladdress' => ['nullable'],
            'personalfile' => 'nullable',
            'personalgroups' => 'nullable',

        ];

        return $request->validate($rules);
    }
    /**
     * Save user by real type
     * @param array $data
     * @return void
     */
    public function realSave($data)
    {
        $password = Str::random(10);
        if (empty($data['personaluserid'])) $user = new User();
        else $user = User::find($data['personaluserid']);
        $user->fullname = $data['personalfullname'];
        $user->email = $data['personalemail'];
        $user->mobile = $data['personalmobile'];
        if (empty($data['personaluserid'])) {
            $user->terms = 1;
            $user->password = $password;
            $user->company = null;
            $user->company_signatory = null;
            $user->taxcode = null;
            $user->role = 'User';
            $user->status = 1;
            $user->type = 'real';
        }
        $user->Identity = $data['personalidentity'];
        $user->phone = $data['personalphone'];
        $user->postcode = $data['personalpostcode'];
        $user->address = $data['personaladdress'];
        $user->file = $data['personalfile'];
        $user->save();
        $data['personalgroups'] = isset($data['personalgroups'])?$data['personalgroups']:[];
        $user->customergroups()->sync($data['personalgroups']);

        $senddata = ['fullname' => $data['personalfullname'], 'email' => $data['personalemail']];
        if (empty($data['personaluserid'])) $user->notifyNow(new PasswordSent($senddata, $password));
    }

    /**
     * Validate user by legal type
     * @param Request $request
     * @return array $validate
     */
    public function legalValidator(Request $request)
    {
        $rules = [
            'companyuserid' => ['nullable', 'integer'],
            'companyname' => ['required', 'string', 'max:255'],
            'companyidentity' => ['required'],
            'companytax' => ['nullable'],
            'companysign' => ['nullable'],
            'companymobile' => ['required', 'min:11', Rule::unique('users', 'mobile')->ignore($request->input('companyuserid'))],
            'companyphone' => ['nullable', 'numeric', 'min:11'],
            'companyemail' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($request->input('companyuserid'))],
            'companypostcode' => ['nullable', 'min:10', 'max:10'],
            'companyaddress' => ['nullable'],
            'companyfile' => 'nullable',
            'companygroups' => 'array|nullable',

        ];

        return $request->validate($rules);
    }
    /**
     * Save user by legal type
     * @param array $data
     * @return void
     */
    public function legalSave($data)
    {
        $password = Str::random(10);
        if (empty($data['companyuserid'])) $user = new User();
        else $user = User::find($data['companyuserid']);
        $user->company = $data['companyname'];
        $user->email = $data['companyemail'];
        $user->mobile = $data['companymobile'];
        $user->company_signatory = $data['companysign'];
        $user->taxcode = $data['companytax'];
        if (empty($data['companyuserid'])) {
            $user->terms = 1;
            $user->password = $password;
            $user->fullname = null;
            $user->role = 'User';
            $user->status = 1;
            $user->type = 'legal';
        }
        $user->Identity = $data['companyidentity'];
        $user->phone = $data['companyphone'];
        $user->postcode = $data['companypostcode'];
        $user->address = $data['companyaddress'];
        $user->file = $data['companyfile'];
        $user->save();
        $data['companygroups'] = isset($data['companygroups'])?$data['companygroups']:[];
        $user->customergroups()->sync($data['companygroups']);

        $senddata = ['fullname' => $data['companyname'], 'email' => $data['companyemail']];
        if (empty($data['companyuserid'])) $user->notifyNow(new PasswordSent($senddata, $password));
    }
}
