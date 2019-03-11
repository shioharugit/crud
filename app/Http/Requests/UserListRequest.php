<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserListRequest extends FormRequest
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
            'name' => 'nullable|regex:/^[a-zA-Z]+$/|max:255',
            'email' => 'nullable|max:255',
            'age' => 'nullable|numeric|digits_between:0,2',
        ];
    }
}
