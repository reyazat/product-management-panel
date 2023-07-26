<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required','string','min:3','max:191',Rule::unique('categories', 'name')->ignore($this->input('editid'))],
            'slug' => ['nullable','string','min:3','max:191',Rule::unique('categories', 'slug')->ignore($this->input('editid'))],
            'description' => 'nullable|string',
            'Parent' => 'nullable|integer',
            'image' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|integer',
            'ajax' => 'required|boolean',
        ];
    }
}
