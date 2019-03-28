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
            'name' => 'required|regex:/\A[a-zA-Z]+\z/|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|regex:/\A[0-9a-zA-Z]+\z/|between:8,16',
            'password_confirmation' => 'required|regex:/\A[0-9a-zA-Z]+\z/|between:8,16|same:password',
            'age' => 'nullable|numeric|digits_between:0,2',
            'authority' => 'required|in:'.config('const.USER_AUTHORITY.ADMIN').','.config('const.USER_AUTHORITY.USER'),
        ];
    }
}
