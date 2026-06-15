<?php

/*
|--------------------------------------------------------------------------
| Default Validation Language Lines (Arabic)
|--------------------------------------------------------------------------
|
| This file contains the default error messages used by the Validator
| class when no application-level translation file is found.
|
*/

return [

    'required' => 'حقل :attribute مطلوب.',
    'string' => 'يجب أن يكون حقل :attribute نصاً.',
    'alpha' => 'يجب أن يحتوي حقل :attribute على أحرف فقط.',
    'alpha_num' => 'يجب أن يحتوي حقل :attribute على أحرف وأرقام فقط.',
    'numeric' => 'يجب أن يكون حقل :attribute رقماً.',
    'integer' => 'يجب أن يكون حقل :attribute عدداً صحيحاً.',
    'boolean' => 'يجب أن يكون حقل :attribute صحيحاً أو خاطئاً (true/false).',
    'array' => 'يجب أن يكون حقل :attribute مصفوفة.',
    'object' => 'يجب أن يكون حقل :attribute كائناً (object).',
    'email' => 'يجب أن يكون حقل :attribute عنوان بريد إلكتروني صحيحاً.',
    'phone' => 'يجب أن يكون حقل :attribute رقم هاتف صحيحاً.',
    'url' => 'صيغة حقل :attribute غير صحيحة.',
    'domain' => 'يجب أن يكون حقل :attribute نطاقاً (domain) صحيحاً.',
    'ip' => 'يجب أن يكون حقل :attribute عنوان IP صحيحاً.',
    'mac' => 'يجب أن يكون حقل :attribute عنوان MAC صحيحاً.',
    'json' => 'يجب أن يكون حقل :attribute سلسلة JSON صحيحة.',
    'regex' => 'صيغة حقل :attribute غير صحيحة.',
    'date' => 'حقل :attribute ليس تاريخاً صحيحاً.',

    'in' => 'القيمة المحددة لـ :attribute غير صحيحة.',
    'not_in' => 'القيمة المحددة لـ :attribute غير صحيحة.',

    'different' => 'يجب أن يكون حقل :attribute و :other مختلفين.',
    'confirmed' => 'تأكيد حقل :attribute غير متطابق.',

    'digits' => 'يجب أن يحتوي حقل :attribute على :digits أرقام.',
    'digits_between' => 'يجب أن يحتوي حقل :attribute على عدد أرقام بين :min و :max.',

    'min' => [
        'numeric' => 'يجب أن لا تقل قيمة حقل :attribute عن :min.',
        'string' => 'يجب أن لا يقل حقل :attribute عن :min حرفاً.',
        'array' => 'يجب أن يحتوي حقل :attribute على :min عناصر على الأقل.',
    ],

    'max' => [
        'numeric' => 'يجب أن لا تزيد قيمة حقل :attribute عن :max.',
        'string' => 'يجب أن لا يزيد حقل :attribute عن :max حرفاً.',
        'array' => 'يجب أن لا يحتوي حقل :attribute على أكثر من :max عناصر.',
    ],

    'between' => [
        'numeric' => 'يجب أن تكون قيمة حقل :attribute بين :min و :max.',
        'string' => 'يجب أن يكون حقل :attribute بين :min و :max حرفاً.',
        'array' => 'يجب أن يحتوي حقل :attribute على عناصر بين :min و :max.',
    ],

];
