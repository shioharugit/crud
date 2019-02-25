<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Z]+$/|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|regex:/^[0-9a-zA-Z]+$/|between:8,16',
            'confirm_password' => 'required|regex:/^[0-9a-zA-Z]+$/|between:8,16|same:password',
            'age' => 'nullable|numeric|digits_between:0,2',
        ];
    }
}
