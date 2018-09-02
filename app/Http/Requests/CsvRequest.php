<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvRequest extends FormRequest
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
            'csv_file' => [
                'required',
                'max:1024', // php.ini��upload_max_filesize��post_max_size���l������K�v������̂Œ���
                'file',
                'mimes:csv,txt', // mimes�̓s����text/csv�Ȃ̂�txt�������K�v
                'mimetypes:text/plain',
            ],
        ];
    }
}
