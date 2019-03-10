<?php

return [
    // usersテーブルステータス(0:会員 1:仮会員 9:退会)
    'USER_STATUS' => ['MEMBER' => '0', 'PROVISIONAL_MEMBER' => '1', 'UNSUBSCRIBE' => '9'],

    // CSVの登録タイプ(1:登録 2:編集 3:削除)
    'CSV_TYPE' => ['REGISTER' => '1', 'EDIT' => '2', 'DELETE' => '3'],

    // CSVのヘッダーの順序
    'CSV_HEADER_NUM' => [
        'TYPE' => [
            'NAME' => 'type',
            'INDEX' => 0,
        ],
        'ID' => [
            'NAME' => 'id',
            'INDEX' => 1,
        ],
        'NAME' => [
            'NAME' => 'name',
            'INDEX' => 2,
        ],
        'EMAIL' => [
            'NAME' => 'email',
            'INDEX' => 3,
        ],
        'PASSWORD' => [
            'NAME' => 'password',
            'INDEX' => 4,
        ],
        'AGE' => [
            'NAME' => 'age',
            'INDEX' => 5,
        ],
    ],

    // CSVインポート最大許容行数
    'CSV_IMPORT_MAX_LINE' => 50,

    // 日付フォーマット
    'DEFAULT_DATE_FORMAT' => 'Y-m-d H:i:s',
];
