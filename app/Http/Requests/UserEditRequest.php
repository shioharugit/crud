<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
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
            'id' => 'nullable|numeric|digits_between:0,10',
            'name' => 'required|regex:/^[a-zA-Z]+$/|max:255',
            'email' => ['required','email','max:255',Rule::unique('users')->ignore($this->id)],
            'password' => 'nullable|regex:/^[0-9a-zA-Z]+$/|between:8,16',
            'password_confirmation' => 'required_with:password|nullable|regex:/^[0-9a-zA-Z]+$/|between:8,16|same:password',
            'age' => 'nullable|numeric|digits_between:0,2',
            'authority' => 'required|in:'.config('const.USER_AUTHORITY.ADMIN').','.config('const.USER_AUTHORITY.USER'),
            'status' => 'required|in:'.config('const.USER_STATUS.MEMBER').','.config('const.USER_STATUS.UNSUBSCRIBE'),
        ];
    }
}
