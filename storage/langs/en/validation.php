<?php

/*
|--------------------------------------------------------------------------
| Default Validation Language Lines
|--------------------------------------------------------------------------
|
| This file contains the default error messages used by the Validator
| class when no application-level translation file is found.
|
*/

return [

    'required' => 'The :attribute field is required.',
    'string' => 'The :attribute must be a string.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'numeric' => 'The :attribute must be a number.',
    'integer' => 'The :attribute must be an integer.',
    'boolean' => 'The :attribute field must be true or false.',
    'array' => 'The :attribute must be an array.',
    'object' => 'The :attribute must be an object.',
    'email' => 'The :attribute must be a valid email address.',
    'phone' => 'The :attribute must be a valid phone number.',
    'url' => 'The :attribute format is invalid.',
    'domain' => 'The :attribute must be a valid domain.',
    'ip' => 'The :attribute must be a valid IP address.',
    'mac' => 'The :attribute must be a valid MAC address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'regex' => 'The :attribute format is invalid.',
    'date' => 'The :attribute is not a valid date.',

    'in' => 'The selected :attribute is invalid.',
    'not_in' => 'The selected :attribute is invalid.',

    'different' => 'The :attribute and :other must be different.',
    'confirmed' => 'The :attribute confirmation does not match.',

    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',

    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],

    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],

    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],

];