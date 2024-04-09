<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
              // 'title' => 'required|min:5|max:255'
            'title' => ['required', 'min:5', 'max:255'],
            'description' => ['required', 'min:30', 'max:30000'],
            'image' => ['required', 'image', 'mimes:png,jpg,svg']
        ];
    }
}
