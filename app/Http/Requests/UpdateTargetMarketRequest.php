<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTargetMarketRequest extends FormRequest
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
            'name' => ['required','string','min:3','max:191',Rule::unique('target_markets', 'name')->ignore($this->input('editid'))],
            'slug' => ['nullable','string','min:3','max:191',Rule::unique('target_markets', 'slug')->ignore($this->input('editid'))],
            'description' => 'nullable|string',
            'approve_customer' => 'boolean',
            'status' => 'required|integer',
            'ajax' => 'required|boolean',
        ];
    }
}
