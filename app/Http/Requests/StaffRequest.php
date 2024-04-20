<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'name' => 'required|string|max:65',
            'email' => 'required|string|max:65|unique:admins,email',
            'username' => 'required|string|max:65|unique:admins,username',
            'phone_number' => 'required|string|max:65|unique:admins,phone_number',
            'password' => 'required|min:8|max:15',
        ];
    }
}
