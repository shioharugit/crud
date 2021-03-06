<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreregisterRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:users,email,null,id,status,'.config('const.USER_STATUS.MEMBER'),
            // uniqueは「ステータスが会員でemailが登録済みであるかどうか」のルールです
        ];
    }
}
