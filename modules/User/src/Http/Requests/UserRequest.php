<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'registered_at' => ['required', 'url']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'validation.name.required',
            'name.string' => 'validation.name.string',
            'name.max' => 'validation.name.max',
            'email.required' => 'validation.email.required',
            'email.string' => 'validation.email.string',
            'email.email' => 'validation.email.email',
            'email.max' => 'validation.email.max',
            'email.unique' => 'validation.email.unique',
            'password.required' => 'validation.password.required',
            'password.string' => 'validation.password.string',
            'password.min' => 'validation.password.min',
            'password.confirmed' => 'validation.password.confirmed',
            'registered_at.required' => 'validation.registered_at.required',
            'registered_at.url' => 'validation.registered_at.url',
        ];
    }
}
