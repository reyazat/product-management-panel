<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTargetMarketRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:191|unique:target_markets,name',
            'slug' => 'nullable|string|min:3|max:191|unique:target_markets,slug',
            'description' => 'nullable|string',
            'approve_customer' => 'nullable|boolean',
            'ajax' => 'required|boolean',
        ];
    }
}
