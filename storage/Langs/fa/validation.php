<?php

/*
|--------------------------------------------------------------------------
| Default Validation Language Lines (Persian)
|--------------------------------------------------------------------------
|
| This file contains the default error messages used by the Validator
| class when no application-level translation file is found.
|
*/

return [

    'required' => 'فیلد :attribute الزامی است.',
    'string' => 'فیلد :attribute باید متن باشد.',
    'alpha' => 'فیلد :attribute باید فقط شامل حروف باشد.',
    'alpha_num' => 'فیلد :attribute باید فقط شامل حروف و اعداد باشد.',
    'numeric' => 'فیلد :attribute باید عدد باشد.',
    'integer' => 'فیلد :attribute باید عدد صحیح باشد.',
    'boolean' => 'فیلد :attribute باید true یا false باشد.',
    'array' => 'فیلد :attribute باید آرایه باشد.',
    'object' => 'فیلد :attribute باید آبجکت باشد.',
    'email' => 'فیلد :attribute باید یک آدرس ایمیل معتبر باشد.',
    'phone' => 'فیلد :attribute باید یک شماره تلفن معتبر باشد.',
    'url' => 'فرمت فیلد :attribute نامعتبر است.',
    'domain' => 'فیلد :attribute باید یک دامنه معتبر باشد.',
    'ip' => 'فیلد :attribute باید یک آدرس IP معتبر باشد.',
    'mac' => 'فیلد :attribute باید یک آدرس MAC معتبر باشد.',
    'json' => 'فیلد :attribute باید یک رشته JSON معتبر باشد.',
    'regex' => 'فرمت فیلد :attribute نامعتبر است.',
    'date' => 'فیلد :attribute یک تاریخ معتبر نیست.',

    'in' => 'مقدار انتخاب‌شده برای :attribute نامعتبر است.',
    'not_in' => 'مقدار انتخاب‌شده برای :attribute نامعتبر است.',

    'different' => 'فیلدهای :attribute و :other باید متفاوت باشند.',
    'confirmed' => 'تکرار فیلد :attribute مطابقت ندارد.',

    'digits' => 'فیلد :attribute باید :digits رقم باشد.',
    'digits_between' => 'فیلد :attribute باید بین :min و :max رقم باشد.',

    'min' => [
        'numeric' => 'فیلد :attribute باید حداقل :min باشد.',
        'string' => 'فیلد :attribute باید حداقل :min کاراکتر باشد.',
        'array' => 'فیلد :attribute باید حداقل :min آیتم داشته باشد.',
    ],

    'max' => [
        'numeric' => 'فیلد :attribute نباید بیشتر از :max باشد.',
        'string' => 'فیلد :attribute نباید بیشتر از :max کاراکتر باشد.',
        'array' => 'فیلد :attribute نباید بیشتر از :max آیتم داشته باشد.',
    ],

    'between' => [
        'numeric' => 'فیلد :attribute باید بین :min و :max باشد.',
        'string' => 'فیلد :attribute باید بین :min و :max کاراکتر باشد.',
        'array' => 'فیلد :attribute باید بین :min و :max آیتم داشته باشد.',
    ],

];