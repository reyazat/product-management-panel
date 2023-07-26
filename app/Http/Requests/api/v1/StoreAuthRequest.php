<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:255',
            /*'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|min:11|max:11|regex:/^09[0-9]{9}$/|unique:users',
            'password' => 'required|min:8|confirmed',
            'terms' => 'accepted',
            'type' => '',
            'Identity' => '',
            'company' => '',
            'company_signatory' => '',
            'phone' => '',
            'postcode' => '',
            'address' => '',
            'taxcode' => '',
            'file' => '',*/
        ];
    }
}
