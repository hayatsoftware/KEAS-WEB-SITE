<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = 'Format :attribute jest nieprawidłowy.';
$str4 = 'Zaznaczony :attribute jest nieprawidłowy.';
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => ':attribute musi zostać zaakceptowany.',
    'active_url'           => ':attribute jest nieprawidłowym adresem URL.',
    'after'                => ':attribute musi być datą późniejszą od :date.',
    'after_or_equal'       => ':attribute musi być datą nie wcześniejszą niż :date.',
    'alpha'                => ':attribute może zawierać jedynie litery.',
    'alpha_dash'           => ':attribute może zawierać jedynie litery, cyfry i myślniki.',
    'alpha_num'            => ':attribute może zawierać jedynie litery i cyfry.',
    $str => ':attribute musi być tablicą.',
    'before'               => ':attribute musi być datą wcześniejszą od :date.',
    'before_or_equal'      => ':attribute musi być datą nie późniejszą niż :date.',
    'between'              => [
        $str1 => ':attribute musi zawierać się w granicach :min - :max.',
        'file'    => ':attribute musi zawierać się w granicach :min - :max kilobajtów.',
        $str2 => ':attribute musi zawierać się w granicach :min - :max znaków.',
        $str => ':attribute musi składać się z :min - :max elementów.',
    ],
    'boolean'              => ':attribute musi mieć wartość prawda albo fałsz',
    'confirmed'            => 'Potwierdzenie :attribute nie zgadza się.',
    'date'                 => ':attribute nie jest prawidłową datą.',
    'date_equals'          => ':attribute musi być datą równą :date.',
    'date_format'          => ':attribute nie jest w formacie :format.',
    'different'            => ':attribute oraz :other muszą się różnić.',
    'digits'               => ':attribute musi składać się z :digits cyfr.',
    'digits_between'       => ':attribute musi mieć od :min do :max cyfr.',
    'dimensions'           => ':attribute ma niepoprawne wymiary.',
    'distinct'             => ':attribute ma zduplikowane wartości.',
    'email'                => $str3,
    'exists'               => $str4,
    'file'                 => ':attribute musi być plikiem.',
    'filled'               => 'Pole :attribute jest wymagane.',
    'gt'                   => [
        $str1 => ':attribute musi być większy niż :value.',
        'file'    => ':attribute musi być większy niż :value kilobajtów.',
        $str2 => ':attribute musi być dłuższy niż :value znaków.',
        $str => ':attribute musi mieć więcej niż :value elementów.',
    ],
    'gte'                  => [
        $str1 => ':attribute musi być większy lub równy :value.',
        'file'    => ':attribute musi być większy lub równy :value kilobajtów.',
        $str2 => ':attribute musi być dłuższy lub równy :value znaków.',
        $str => ':attribute musi mieć :value lub więcej elementów.',
    ],
    'image'                => ':attribute musi być obrazkiem.',
    'in'                   => $str4,
    'in_array'             => ':attribute nie znajduje się w :other.',
    'integer'              => ':attribute musi być liczbą całkowitą.',
    'ip'                   => ':attribute musi być prawidłowym adresem IP.',
    'ipv4'                 => ':attribute musi być prawidłowym adresem IPv4.',
    'ipv6'                 => ':attribute musi być prawidłowym adresem IPv6.',
    'json'                 => ':attribute musi być poprawnym ciągiem znaków JSON.',
    'lt'                   => [
        $str1 => ':attribute musi być mniejszy niż :value.',
        'file'    => ':attribute musi być mniejszy niż :value kilobajtów.',
        $str2 => ':attribute musi być krótszy niż :value znaków.',
        $str => ':attribute musi mieć mniej niż :value elementów.',
    ],
    'lte'                  => [
        $str1 => ':attribute musi być mniejszy lub równy :value.',
        'file'    => ':attribute musi być mniejszy lub równy :value kilobajtów.',
        $str2 => ':attribute musi być krótszy lub równy :value znaków.',
        $str => ':attribute musi mieć :value lub mniej elementów.',
    ],
    'max'                  => [
        $str1 => ':attribute nie może być większy niż :max.',
        'file'    => ':attribute nie może być większy niż :max kilobajtów.',
        $str2 => ':attribute nie może być dłuższy niż :max znaków.',
        $str => ':attribute nie może mieć więcej niż :max elementów.',
    ],
    'mimes'                => ':attribute musi być plikiem typu :values.',
    'mimetypes'            => ':attribute musi być plikiem typu :values.',
    'min'                  => [
        $str1 => ':attribute musi być nie mniejszy od :min.',
        'file'    => ':attribute musi mieć przynajmniej :min kilobajtów.',
        $str2 => ':attribute musi mieć przynajmniej :min znaków.',
        $str => ':attribute musi mieć przynajmniej :min elementów.',
    ],
    'not_in'               => $str4,
    'not_regex'            => $str3,
    $str1 => ':attribute musi być liczbą.',
    'present'              => 'Pole :attribute musi być obecne.',
    'regex'                => $str3,
    'required'             => 'Pole :attribute jest wymagane.',
    'required_if'          => 'Pole :attribute jest wymagane gdy :other jest :value.',
    'required_unless'      => ':attribute jest wymagany jeżeli :other nie znajduje się w :values.',
    'required_with'        => 'Pole :attribute jest wymagane gdy :values jest obecny.',
    'required_with_all'    => 'Pole :attribute jest wymagane gdy :values jest obecny.',
    'required_without'     => 'Pole :attribute jest wymagane gdy :values nie jest obecny.',
    'required_without_all' => 'Pole :attribute jest wymagane gdy żadne z :values nie są obecne.',
    'same'                 => 'Pole :attribute i :other muszą się zgadzać.',
    'size'                 => [
        $str1 => ':attribute musi mieć :size.',
        'file'    => ':attribute musi mieć :size kilobajtów.',
        $str2 => ':attribute musi mieć :size znaków.',
        $str => ':attribute musi zawierać :size elementów.',
    ],
    'starts_with'          => ':attribute musi się zaczynać jednym z wymienionych: :values',
    $str2 => ':attribute musi być ciągiem znaków.',
    'timezone'             => ':attribute musi być prawidłową strefą czasową.',
    'unique'               => 'Taki :attribute już występuje.',
    'uploaded'             => 'Nie udało się wgrać pliku :attribute.',
    'url'                  => $str3,
    'uuid'                 => ':attribute musi być poprawnym identyfikatorem UUID.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
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

    'attributes' => [
    ],
];
