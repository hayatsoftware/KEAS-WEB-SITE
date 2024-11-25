<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
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

    'accepted'             => ':attribute skal accepteres.',
    'active_url'           => ':attribute er ikke en gyldig URL.',
    'after'                => ':attribute skal være en dato efter :date.',
    'after_or_equal'       => ':attribute skal være en dato efter eller lig med :date.',
    'alpha'                => ':attribute må kun bestå af bogstaver.',
    'alpha_dash'           => ':attribute må kun bestå af bogstaver, tal og bindestreger.',
    'alpha_num'            => ':attribute må kun bestå af bogstaver og tal.',
    $str => ':attribute skal være et array.',
    'before'               => ':attribute skal være en dato før :date.',
    'before_or_equal'      => ':attribute skal være en dato før eller lig med :date.',
    'between'              => [
        $str1 => ':attribute skal være mellem :min - :max.',
        'file'    => ':attribute skal være mellem :min - :max kilobytes.',
        $str2 => ':attribute skal være mellem :min - :max tegn.',
        $str => ':attribute skal indeholde mellem :min - :max elementer.',
    ],
    'boolean'              => ':attribute skal være sandt eller falsk',
    'confirmed'            => ':attribute er ikke det samme som bekræftelsesfeltet.',
    'date'                 => ':attribute er ikke en gyldig dato.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute matcher ikke formatet :format.',
    'different'            => ':attribute og :other skal være forskellige.',
    'digits'               => ':attribute skal have :digits cifre.',
    'digits_between'       => ':attribute skal have mellem :min og :max cifre.',
    'dimensions'           => ':attribute har forkerte billede dimensioner.',
    'distinct'             => ':attribute har en duplikatværdi.',
    'email'                => ':attribute skal være en gyldig e-mailadresse.',
    'exists'               => 'Det valgte :attribute er ugyldig.',
    'file'                 => ':attribute skal være en fil.',
    'filled'               => ':attribute skal udfyldes.',
    'gt'                   => [
        $str1 => 'The :attribute skal være større end :value.',
        'file'    => 'The :attribute skal være større end :value kilobytes.',
        $str2 => 'The :attribute skal være større end :value characters.',
        $str => 'The :attribute skal være mere end :value items.',
    ],
    'gte'                  => [
        $str1 => 'The :attribute skal være større end eller lig med :value.',
        'file'    => 'The :attribute skal være større end eller lig med :value kilobytes.',
        $str2 => 'The :attribute skal være større end eller lig med :value characters.',
        $str => 'The :attribute skal have :value items eller mere.',
    ],
    'image'                => ':attribute skal være et billede.',
    'in'                   => 'Det valgte :attribute er ugyldig.',
    'in_array'             => ':attribute eksisterer ikke i :other.',
    'integer'              => ':attribute skal være et heltal.',
    'ip'                   => ':attribute skal være en gyldig IP adresse.',
    'ipv4'                 => ':attribute skal være en gyldig IPv4 adresse.',
    'ipv6'                 => ':attribute skal være en gyldig IPv6 adresse.',
    'json'                 => ':attribute skal være en gyldig JSON streng.',
    'lt'                   => [
        $str1 => 'The :attribute skal være mindre end :value.',
        'file'    => 'The :attribute skal være mindre end :value kilobytes.',
        $str2 => 'The :attribute skal være mindre end :value characters.',
        $str => 'The :attribute skal have mindre end :value items.',
    ],
    'lte'                  => [
        $str1 => 'The :attribute skal være mindre eller lig med :value.',
        'file'    => 'The :attribute skal være mindre eller lig med :value kilobytes.',
        $str2 => 'The :attribute skal være mindre eller lig med :value characters.',
        $str => 'The :attribute må ikke have mere end :value items.',
    ],
    'max'                  => [
        $str1 => ':attribute skal være højest :max.',
        'file'    => ':attribute skal være højest :max kilobytes.',
        $str2 => ':attribute skal være højest :max tegn.',
        $str => ':attribute må ikke indeholde mere end :max elementer.',
    ],
    'mimes'                => ':attribute skal være en fil af typen: :values.',
    'mimetypes'            => ':attribute skal være en fil af typen: :values.',
    'min'                  => [
        $str1 => ':attribute skal være mindst :min.',
        'file'    => ':attribute skal være mindst :min kilobytes.',
        $str2 => ':attribute skal være mindst :min tegn.',
        $str => ':attribute skal indeholde mindst :min elementer.',
    ],
    'not_in'               => 'Den valgte :attribute er ugyldig.',
    'not_regex'            => 'The :attribute format is invalid.',
    $str1 => ':attribute skal være et tal.',
    'present'              => ':attribute skal være tilstede.',
    'regex'                => ':attribute formatet er ugyldigt.',
    'required'             => ':attribute skal udfyldes.',
    'required_if'          => ':attribute skal udfyldes når :other er :value.',
    'required_unless'      => ':attribute er påkrævet med mindre :other findes i :values.',
    'required_with'        => ':attribute skal udfyldes når :values er udfyldt.',
    'required_with_all'    => ':attribute skal udfyldes når :values er udfyldt.',
    'required_without'     => ':attribute skal udfyldes når :values ikke er udfyldt.',
    'required_without_all' => ':attribute skal udfyldes når ingen af :values er udfyldt.',
    'same'                 => ':attribute og :other skal være ens.',
    'size'                 => [
        $str1 => ':attribute skal være :size.',
        'file'    => ':attribute skal være :size kilobytes.',
        $str2 => ':attribute skal være :size tegn lang.',
        $str => ':attribute skal indeholde :size elementer.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => ':attribute skal være en streng.',
    'timezone'             => ':attribute skal være en gyldig tidszone.',
    'unique'               => ':attribute er allerede taget.',
    'uploaded'             => ':attribute fejlene i uploaden.',
    'url'                  => ':attribute formatet er ugyldigt.',
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
