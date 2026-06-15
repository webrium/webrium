<?php

/*
|--------------------------------------------------------------------------
| Default Validation Language Lines (Japanese)
|--------------------------------------------------------------------------
|
| This file contains the default error messages used by the Validator
| class when no application-level translation file is found.
|
*/

return [

    'required' => ':attribute フィールドは必須です。',
    'string' => ':attribute フィールドは文字列である必要があります。',
    'alpha' => ':attribute フィールドは文字のみで構成してください。',
    'alpha_num' => ':attribute フィールドは英数字のみで構成してください。',
    'numeric' => ':attribute フィールドは数値である必要があります。',
    'integer' => ':attribute フィールドは整数である必要があります。',
    'boolean' => ':attribute フィールドは true または false である必要があります。',
    'array' => ':attribute フィールドは配列である必要があります。',
    'object' => ':attribute フィールドはオブジェクトである必要があります。',
    'email' => ':attribute フィールドは有効なメールアドレスである必要があります。',
    'phone' => ':attribute フィールドは有効な電話番号である必要があります。',
    'url' => ':attribute の形式が無効です。',
    'domain' => ':attribute フィールドは有効なドメインである必要があります。',
    'ip' => ':attribute フィールドは有効なIPアドレスである必要があります。',
    'mac' => ':attribute フィールドは有効なMACアドレスである必要があります。',
    'json' => ':attribute フィールドは有効なJSON文字列である必要があります。',
    'regex' => ':attribute の形式が無効です。',
    'date' => ':attribute は有効な日付ではありません。',

    'in' => '選択された :attribute は無効です。',
    'not_in' => '選択された :attribute は無効です。',

    'different' => ':attribute と :other は異なる必要があります。',
    'confirmed' => ':attribute の確認が一致しません。',

    'digits' => ':attribute フィールドは :digits 桁である必要があります。',
    'digits_between' => ':attribute フィールドは :min 桁から :max 桁の間である必要があります。',

    'min' => [
        'numeric' => ':attribute フィールドは :min 以上である必要があります。',
        'string' => ':attribute フィールドは :min 文字以上である必要があります。',
        'array' => ':attribute フィールドは :min 個以上の項目が必要です。',
    ],

    'max' => [
        'numeric' => ':attribute フィールドは :max 以下である必要があります。',
        'string' => ':attribute フィールドは :max 文字以下である必要があります。',
        'array' => ':attribute フィールドは :max 個以下の項目である必要があります。',
    ],

    'between' => [
        'numeric' => ':attribute フィールドは :min から :max の間である必要があります。',
        'string' => ':attribute フィールドは :min 文字から :max 文字の間である必要があります。',
        'array' => ':attribute フィールドは :min 個から :max 個の項目を含む必要があります。',
    ],

];
