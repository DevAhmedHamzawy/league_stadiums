<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required|unique:users|string|max:255',
            'first_name' => 'required|unique:users|string|max:255',
            'last_name' => 'required|unique:users|string|max:255',
            'age' => 'required|numeric|max:255',
            'birthdate' => 'required',
            'mobile' => 'required|numeric|unique',
            'email' => 'required|string|email|max:255|unique:users',
            'city' => 'required|string|max:255',
            'role' => 'required',
            'password' => 'required',
        ];
    }
}
