<?php

namespace App\Http\Requests\api\v1;

use App\Http\Helpers\Helpers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class FirstRequest extends FormRequest
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
            'mobile' => 'required|min:11|max:11|regex:/^09[0-9]{9}$/|unique:users',
            'terms' => 'accepted',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $message = (new ValidationException($validator))->getMessage();
        throw new HttpResponseException(
            Helpers::setResponse([
            'message'=>$message,
            'status'=>'error',
            'code'=> 422,
            'errors' => $validator->errors()
        ])
    );
    }


}
