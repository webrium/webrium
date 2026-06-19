<?php

/*
|--------------------------------------------------------------------------
| Default Validation Language Lines (Chinese Simplified)
|--------------------------------------------------------------------------
|
| This file contains the default error messages used by the Validator
| class when no application-level translation file is found.
|
*/

return [

    'required' => ':attribute 字段为必填项。',
    'string' => ':attribute 字段必须是字符串。',
    'alpha' => ':attribute 字段只能包含字母。',
    'alpha_num' => ':attribute 字段只能包含字母和数字。',
    'numeric' => ':attribute 字段必须是数字。',
    'integer' => ':attribute 字段必须是整数。',
    'boolean' => ':attribute 字段必须是 true 或 false。',
    'array' => ':attribute 字段必须是数组。',
    'object' => ':attribute 字段必须是对象。',
    'email' => ':attribute 字段必须是有效的电子邮件地址。',
    'phone' => ':attribute 字段必须是有效的电话号码。',
    'url' => ':attribute 字段格式无效。',
    'domain' => ':attribute 字段必须是有效的域名。',
    'ip' => ':attribute 字段必须是有效的 IP 地址。',
    'mac' => ':attribute 字段必须是有效的 MAC 地址。',
    'json' => ':attribute 字段必须是有效的 JSON 字符串。',
    'regex' => ':attribute 字段格式无效。',
    'date' => ':attribute 字段不是有效的日期。',

    'in' => '所选的 :attribute 无效。',
    'not_in' => '所选的 :attribute 无效。',

    'different' => ':attribute 和 :other 必须不同。',
    'confirmed' => ':attribute 的确认不匹配。',

    'digits' => ':attribute 字段必须是 :digits 位数字。',
    'digits_between' => ':attribute 字段必须是 :min 到 :max 位数字。',

    'min' => [
        'numeric' => ':attribute 字段不能小于 :min。',
        'string' => ':attribute 字段至少需要 :min 个字符。',
        'array' => ':attribute 字段至少需要 :min 个项目。',
    ],

    'max' => [
        'numeric' => ':attribute 字段不能大于 :max。',
        'string' => ':attribute 字段不能超过 :max 个字符。',
        'array' => ':attribute 字段不能超过 :max 个项目。',
    ],

    'between' => [
        'numeric' => ':attribute 字段必须在 :min 到 :max 之间。',
        'string' => ':attribute 字段必须在 :min 到 :max 个字符之间。',
        'array' => ':attribute 字段必须包含 :min 到 :max 个项目。',
    ],

];
