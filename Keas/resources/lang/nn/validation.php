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

    'accepted'             => ':attribute må aksepterast.',
    'active_url'           => ':attribute er ikkje ein gyldig URL.',
    'after'                => ':attribute må vere ein dato etter :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => ':attribute må berre vere av bokstavar.',
    'alpha_dash'           => ':attribute må berre vere av bokstavar, tal og bindestrekar.',
    'alpha_num'            => ':attribute må berre vere av bokstavar og tal.',
    $str => ':attribute må vere ei matrise.',
    'before'               => ':attribute må vere ein dato før :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        $str1 => ':attribute skal vere mellom :min - :max.',
        'file'    => ':attribute skal vere mellom :min - :max kilobytes.',
        $str2 => ':attribute skal vere mellom :min - :max teikn.',
        $str => ':attribute må ha mellom :min - :max element.',
    ],
    'boolean'              => ':attribute må vere sann eller usann.',
    'confirmed'            => ':attribute er ikkje likt feltet for stadfesting.',
    'date'                 => ':attribute er ikkje ein gyldig dato.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute er ikkje likt formatet :format.',
    'different'            => ':attribute og :other skal vere ulike.',
    'digits'               => ':attribute skal ha :digits siffer.',
    'digits_between'       => ':attribute skal vere mellom :min og :max siffer.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => ':attribute har ein duplikatverdi.',
    'email'                => ':attribute format er ugyldig.',
    'exists'               => 'Det valde :attribute er ugyldig.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => ':attribute må fyllast ut.',
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
    'image'                => ':attribute skal vere eit bilete.',
    'in'                   => 'Det valde :attribute er ugyldig.',
    'in_array'             => ':attribute eksisterer ikkje i :other.',
    'integer'              => ':attribute skal vere eit heiltal.',
    'ip'                   => ':attribute skal vere ei gyldig IP-adresse.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => ':attribute må vere på JSON-format.',
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
        $str1 => ':attribute skal vere mindre enn :max.',
        'file'    => ':attribute skal vere mindre enn :max kilobytes.',
        $str2 => ':attribute skal vere kortare enn :max teikn.',
        $str => ':attribute skal ikkje ha fleire enn :max element.',
    ],
    'mimes'                => ':attribute skal vere ei fil av typen: :values.',
    'mimetypes'            => ':attribute skal vere ei fil av typen: :values.',
    'min'                  => [
        $str1 => ':attribute skal vere større enn :min.',
        'file'    => ':attribute skal vere større enn :min kilobytes.',
        $str2 => ':attribute skal vere lengre enn :min teikn.',
        $str => ':attribute må vere minst :min element.',
    ],
    'not_in'               => 'Den valgte :attribute er ugyldig.',
    'not_regex'            => 'The :attribute format is invalid.',
    $str1 => ':attribute skal vere eit tal.',
    'present'              => ':attribute må vere til stades.',
    'regex'                => 'Formatet på :attribute er ugyldig.',
    'required'             => ':attribute må fyllast ut.',
    'required_if'          => ':attribute må fyllast ut når :other er :value.',
    'required_unless'      => ':attribute må vere til stades viss ikkje :other finnas hjå verdiene :values.',
    'required_with'        => ':attribute må fyllast ut når :values er fylt ut.',
    'required_with_all'    => ':attribute må vere til stades når :values er oppgjeve.',
    'required_without'     => ':attribute må fyllast ut når :values ikkje er fylt ut.',
    'required_without_all' => ':attribute må vere til stades når inga av :values er oppgjeve.',
    'same'                 => ':attribute og :other må vere like.',
    'size'                 => [
        $str1 => ':attribute må vere :size.',
        'file'    => ':attribute må vere :size kilobytes.',
        $str2 => ':attribute må vere :size teikn lang.',
        $str => ':attribute må innehalde :size element.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => ':attribute må vere ein tekststreng.',
    'timezone'             => ':attribute må vere ei gyldig tidssone.',
    'unique'               => ':attribute er allereie i bruk.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'Formatet på :attribute er ugyldig.',
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
