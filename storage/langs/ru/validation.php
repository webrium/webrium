<?php

/*
|--------------------------------------------------------------------------
| Default Validation Language Lines (Russian)
|--------------------------------------------------------------------------
|
| This file contains the default error messages used by the Validator
| class when no application-level translation file is found.
|
*/

return [

    'required' => 'Поле :attribute обязательно для заполнения.',
    'string' => 'Поле :attribute должно быть строкой.',
    'alpha' => 'Поле :attribute должно содержать только буквы.',
    'alpha_num' => 'Поле :attribute должно содержать только буквы и цифры.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'boolean' => 'Поле :attribute должно быть true или false.',
    'array' => 'Поле :attribute должно быть массивом.',
    'object' => 'Поле :attribute должно быть объектом.',
    'email' => 'Поле :attribute должно быть действительным адресом электронной почты.',
    'phone' => 'Поле :attribute должно быть действительным номером телефона.',
    'url' => 'Формат поля :attribute недействителен.',
    'domain' => 'Поле :attribute должно быть действительным доменом.',
    'ip' => 'Поле :attribute должно быть действительным IP-адресом.',
    'mac' => 'Поле :attribute должно быть действительным MAC-адресом.',
    'json' => 'Поле :attribute должно быть действительной строкой JSON.',
    'regex' => 'Формат поля :attribute недействителен.',
    'date' => 'Поле :attribute не является допустимой датой.',

    'in' => 'Выбранное значение :attribute недействительно.',
    'not_in' => 'Выбранное значение :attribute недействительно.',

    'different' => 'Поля :attribute и :other должны отличаться.',
    'confirmed' => 'Подтверждение поля :attribute не совпадает.',

    'digits' => 'Поле :attribute должно содержать :digits цифр.',
    'digits_between' => 'Поле :attribute должно содержать от :min до :max цифр.',

    'min' => [
        'numeric' => 'Поле :attribute должно быть не менее :min.',
        'string' => 'Поле :attribute должно содержать не менее :min символов.',
        'array' => 'Поле :attribute должно содержать не менее :min элементов.',
    ],

    'max' => [
        'numeric' => 'Поле :attribute не должно быть больше :max.',
        'string' => 'Поле :attribute не должно содержать более :max символов.',
        'array' => 'Поле :attribute не должно содержать более :max элементов.',
    ],

    'between' => [
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'string' => 'Поле :attribute должно содержать от :min до :max символов.',
        'array' => 'Поле :attribute должно содержать от :min до :max элементов.',
    ],

];
