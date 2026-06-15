<?php

/*
|--------------------------------------------------------------------------
| Default Validation Language Lines (German)
|--------------------------------------------------------------------------
|
| This file contains the default error messages used by the Validator
| class when no application-level translation file is found.
|
*/

return [

    'required' => 'Das Feld :attribute ist erforderlich.',
    'string' => 'Das Feld :attribute muss eine Zeichenkette sein.',
    'alpha' => 'Das Feld :attribute darf nur Buchstaben enthalten.',
    'alpha_num' => 'Das Feld :attribute darf nur Buchstaben und Zahlen enthalten.',
    'numeric' => 'Das Feld :attribute muss eine Zahl sein.',
    'integer' => 'Das Feld :attribute muss eine ganze Zahl sein.',
    'boolean' => 'Das Feld :attribute muss true oder false sein.',
    'array' => 'Das Feld :attribute muss ein Array sein.',
    'object' => 'Das Feld :attribute muss ein Objekt sein.',
    'email' => 'Das Feld :attribute muss eine gültige E-Mail-Adresse sein.',
    'phone' => 'Das Feld :attribute muss eine gültige Telefonnummer sein.',
    'url' => 'Das Format des Feldes :attribute ist ungültig.',
    'domain' => 'Das Feld :attribute muss eine gültige Domain sein.',
    'ip' => 'Das Feld :attribute muss eine gültige IP-Adresse sein.',
    'mac' => 'Das Feld :attribute muss eine gültige MAC-Adresse sein.',
    'json' => 'Das Feld :attribute muss eine gültige JSON-Zeichenkette sein.',
    'regex' => 'Das Format des Feldes :attribute ist ungültig.',
    'date' => 'Das Feld :attribute ist kein gültiges Datum.',

    'in' => 'Der ausgewählte Wert für :attribute ist ungültig.',
    'not_in' => 'Der ausgewählte Wert für :attribute ist ungültig.',

    'different' => 'Die Felder :attribute und :other müssen unterschiedlich sein.',
    'confirmed' => 'Die Bestätigung des Feldes :attribute stimmt nicht überein.',

    'digits' => 'Das Feld :attribute muss :digits Ziffern haben.',
    'digits_between' => 'Das Feld :attribute muss zwischen :min und :max Ziffern haben.',

    'min' => [
        'numeric' => 'Das Feld :attribute muss mindestens :min sein.',
        'string' => 'Das Feld :attribute muss mindestens :min Zeichen haben.',
        'array' => 'Das Feld :attribute muss mindestens :min Elemente haben.',
    ],

    'max' => [
        'numeric' => 'Das Feld :attribute darf nicht größer als :max sein.',
        'string' => 'Das Feld :attribute darf nicht mehr als :max Zeichen haben.',
        'array' => 'Das Feld :attribute darf nicht mehr als :max Elemente haben.',
    ],

    'between' => [
        'numeric' => 'Das Feld :attribute muss zwischen :min und :max liegen.',
        'string' => 'Das Feld :attribute muss zwischen :min und :max Zeichen haben.',
        'array' => 'Das Feld :attribute muss zwischen :min und :max Elemente haben.',
    ],

];
