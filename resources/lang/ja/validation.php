<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'failed' => 'These credentials do not match our records.あああああああああ',
    'required' => ':attributeは必須です',
    'numeric' => ':attributeは半角数字で入力してください',
    'between' => [
        'string' => ':attributeは:min～:max文字以内で入力してください',
     ],
    'digits_between' => ':attributeは:max桁以内で入力してください',
    'email' => ':attributeの形式が不正です',
    'max' => ':attributeは:max文字以内で入力してください',
    'uploaded' => 'アップロードに失敗しました',
    'unique' => 'この:attributeは既に登録されています',
    'in' => ':attributeが不正です',
    'required_with'        => ':valuesを入力した場合:attributeは必須です',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'csv_file' => [
            'required' => 'CSVファイルは必須です',
            'max' => [
                'file' => 'ファイルサイズは:maxKB以下にして下さい',
            ],
            'file' => 'CSVファイルを指定して下さい',
            'mimes' => 'CSVファイルを指定して下さい',
            'mimetypes' => 'CSVファイルを指定して下さい',
        ],
        'name' => [
            'regex' => ':attributeは半角英字で入力してください',
        ],
        'password' => [
            'regex' => ':attributeは半角英数字で入力してください',
        ],
        'confirm_password' => [
            'regex' => ':attributeは半角英数字で入力してください',
            'same' => ':attributeはpasswordと同じものを入力してください',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
