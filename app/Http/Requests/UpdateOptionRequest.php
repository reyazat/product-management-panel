<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOptionRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:191', Rule::unique('options', 'name')->ignore($this->input('editid'))],
            'type' => 'required|string',
            'sorted' => 'integer',
            'optionvalues.*.value' => 'required',
            'optionvalues.*.sorted' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'optionvalues.*.value' => 'در صورت اضافه کردن سطر جدید فیلد مقدار را پر  کنید',
            'optionvalues.*.sorted' => 'در صورت اضافه کردن سطر جدید فیلد ترتیب باید عدد صحیح باشد',
        ];
    }
}
