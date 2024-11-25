<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = ':attribute përzgjedhur është i/e pasaktë.';
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

    'accepted'             => ':attribute duhet të pranohet.',
    'active_url'           => ':attribute nuk është adresë e saktë.',
    'after'                => ':attribute duhet të jetë datë pas :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => ':attribute mund të përmbajë vetëm shkronja.',
    'alpha_dash'           => ':attribute mund të përmbajë vetëm shkronja, numra, dhe viza.',
    'alpha_num'            => ':attribute mund të përmbajë vetëm shkronja dhe numra.',
    $str => ':attribute duhet të jetë një bashkësi (array).',
    'before'               => ':attribute duhet të jetë datë para :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        $str1 => ':attribute duhet të jetë midis :min - :max.',
        'file'    => ':attribute duhet të jetë midis :min - :max kilobajtëve.',
        $str2 => ':attribute duhet të jetë midis :min - :max karaktereve.',
        $str => ':attribute duhet të jetë midis :min - :max elementëve.',
    ],
    'boolean'              => 'Fusha :attribute duhet të jetë e vërtetë ose e gabuar',
    'confirmed'            => ':attribute konfirmimi nuk përputhet.',
    'date'                 => ':attribute nuk është një datë e saktë.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute nuk i përshtatet formatit :format.',
    'different'            => ':attribute dhe :other duhet të jenë të ndryshme.',
    'digits'               => ':attribute duhet të jetë :digits shifra.',
    'digits_between'       => ':attribute duhet të jetë midis :min dhe :max shifra.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => ':attribute formati është i pasaktë.',
    'exists'               => $str3,
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'Fusha :attribute është e kërkuar.',
    'gt'                   => [
        $str1 => 'The :attribute must be greater than :value.',
        'file'    => 'The :attribute must be greater than :value kilobytes.',
        $str2 => 'The :attribute must be greater than :value characters.',
        $str => 'The :attribute must have more than :value items.',
    ],
    'gte'                  => [
        $str1 => 'The :attribute must be greater than or equal :value.',
        'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
        $str2 => 'The :attribute must be greater than or equal :value characters.',
        $str => 'The :attribute must have :value items or more.',
    ],
    'image'                => ':attribute duhet të jetë imazh.',
    'in'                   => $str3,
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => ':attribute duhet të jetë numër i plotë.',
    'ip'                   => ':attribute duhet të jetë një IP adresë e saktë.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'lt'                   => [
        $str1 => 'The :attribute must be less than :value.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        $str2 => 'The :attribute must be less than :value characters.',
        $str => 'The :attribute must have less than :value items.',
    ],
    'lte'                  => [
        $str1 => 'The :attribute must be less than or equal :value.',
        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
        $str2 => 'The :attribute must be less than or equal :value characters.',
        $str => 'The :attribute must not have more than :value items.',
    ],
    'max'                  => [
        $str1 => ':attribute nuk mund të jetë më tepër se :max.',
        'file'    => ':attribute nuk mund të jetë më tepër se :max kilobajtë.',
        $str2 => ':attribute nuk mund të jetë më tepër se :max karaktere.',
        $str => ':attribute nuk mund të ketë më tepër se :max elemente.',
    ],
    'mimes'                => ':attribute duhet të jetë një dokument i tipit: :values.',
    'mimetypes'            => ':attribute duhet të jetë një dokument i tipit: :values.',
    'min'                  => [
        $str1 => ':attribute nuk mund të jetë më pak se :min.',
        'file'    => ':attribute nuk mund të jetë më pak se :min kilobajtë.',
        $str2 => ':attribute nuk mund të jetë më pak se :min karaktere.',
        $str => ':attribute nuk mund të ketë më pak se :min elemente.',
    ],
    'not_in'               => $str3,
    'not_regex'            => 'The :attribute format is invalid.',
    $str1 => ':attribute duhet të jetë një numër.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'Formati i :attribute është i pasaktë.',
    'required'             => 'Fusha :attribute është e kërkuar.',
    'required_if'          => 'Fusha :attribute është e kërkuar kur :other është :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'Fusha :attribute është e kërkuar kur :values ekziston.',
    'required_with_all'    => 'Fusha :attribute është e kërkuar kur :values ekziston.',
    'required_without'     => 'Fusha :attribute është e kërkuar kur :values nuk ekziston.',
    'required_without_all' => 'Fusha :attribute është e kërkuar kur nuk ekziston asnjë nga :values.',
    'same'                 => ':attribute dhe :other duhet të përputhen.',
    'size'                 => [
        $str1 => ':attribute duhet të jetë :size.',
        'file'    => ':attribute duhet të jetë :size kilobajtë.',
        $str2 => ':attribute duhet të jetë :size karaktere.',
        $str => ':attribute duhet të ketë :size elemente.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => ':attribute duhet të jetë varg.',
    'timezone'             => ':attribute duhet të jetë zonë e saktë.',
    'unique'               => ':attribute është marrë tashmë.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'Formati i :attribute është i pasaktë.',
    'uuid'                 => 'The :attribute must be a valid UUID.',

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
