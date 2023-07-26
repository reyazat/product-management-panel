<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaxClassRequest extends FormRequest
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
            'name' => ['required','string','min:3','max:191',Rule::unique('tax_classes', 'name')->ignore($this->input('editid'))],
            'rate' => 'required',
            'type' => 'required',
            'status' => 'required|integer',
            'ajax' => 'required|boolean',
        ];
    }
}
