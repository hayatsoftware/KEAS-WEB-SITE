<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = 'Қиммати интихобкардаи :attribute нодуруст мебошад.';
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Қиммати :attribute бояд қабул карда шавад.',
    'active_url'           => 'Қиммати :attribute дорои URL-и нодуруст мебошад.',
    'after'                => 'Қиммати :attribute бояд санаи баъд аз :date бошад.',
    'after_or_equal'       => 'Қиммати :attribute бояд санаи баъд ё баробари :date бошад.',
    'alpha'                => 'Қиммати :attribute метавонад танҳо дорои ҳарфҳои алифо бошад.',
    'alpha_dash'           => 'Қиммати :attribute метавонад танҳо дорои ҳарфҳои алифо, ададҳо ва хати тире бошад.',
    'alpha_num'            => 'Қиммати :attribute метавонад танҳо дорои ҳарфҳои алифо ва ададҳо бошад',
    $str => 'Қиммати :attribute бояд, ки массив бошад.',
    'before'               => 'Қиммати :attribute бояд санаи қабл аз :date бошад.',
    'before_or_equal'      => 'Қиммати :attribute бояд санаи қабл ё баробари :date бошад.',
    'between'              => [
        $str1 => 'Қиммати :attribute бояд байни :min ва :max бошад.',
        'file'    => 'Ҳаҷми файл дар :attribute бояд байни :min ва :max килобайт бошад.',
        $str2 => 'Миқдори аломатҳо дар :attribute бояд байни :min ва :max бошад.',
        $str => 'Миқдори элементҳо дар :attribute бояд байни :min ва :max бошад.',
    ],
    'boolean'              => 'Қиммати :attribute бояд логикӣ дошта бошад.',
    'confirmed'            => 'Қиммати :attribute бо қиммати тасдиқотӣ мувофиқат надорад.',
    'date'                 => 'Қиммати :attribute санаи нодуруст мебошад.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => 'Қиммати :attribute бо формати :format мувофиқат намекунад.',
    'different'            => 'Қимматҳои :attribute ва :other бояд аз ҳам фарқ кунанд.',
    'digits'               => 'Қиммати :attribute бояд :digits рақам дошта бошад.',
    'digits_between'       => 'Қиммати :attribute бояд байни :min ва :max рақам дошта бошад.',
    'dimensions'           => 'Қиммати :attribute дорои андозаи расми нодуруст мебошад.',
    'distinct'             => ':attribute дорои қиммати такроршаванда мебошад.',
    'email'                => 'Қиммати :attribute бояд суроғаи электронии дуруст бошад.',
    'exists'               => $str3,
    'file'                 => 'Қиммати :attribute бояд файл бошад.',
    'filled'               => ':attribute бояд дорои қиммат бошад.',
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
    'image'                => 'Қиммати :attribute бояд расм бошад.',
    'in'                   => $str3,
    'in_array'             => 'Қиммати :attribute дар :other мавҷуд нест.',
    'integer'              => 'Қиммати :attribute бояд адади бутун бошад.',
    'ip'                   => 'Қиммати :attribute бояд суроғаи дурусти IP бошад.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'Қиммати :attribute бояд сатри дурусти JSON бошад.',
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
        $str1 => 'Қиммати :attribute набояд аз :max зиёд бошад.',
        'file'    => 'Ҳаҷми файл дар :attribute набояд аз :max Килобайт зиёд бошад.',
        $str2 => 'Миқдори аломатҳо дар :attribute бояд на зиёда аз :max бошад.',
        $str => 'Миқдори элементҳо дар :attribute бояд на зиёда аз :max бошад.',
    ],
    'mimes'                => ':attribute бояд файли намуди :values бошад.',
    'mimetypes'            => ':attribute бояд файли намуди :values бошад.',
    'min'                  => [
        $str1 => 'Қиммати :attribute набояд аз :min хурд бошад.',
        'file'    => 'Ҳаҷми файл дар :attribute набояд аз :min Килобайт хурд бошад.',
        $str2 => 'Миқдори аломатҳо дар :attribute бояд на кам аз :min бошад.',
        $str => 'Миқдори элементҳо дар :attribute бояд на кам аз :min бошад.',
    ],
    'not_in'               => $str3,
    'not_regex'            => 'The :attribute format is invalid.',
    $str1 => 'Қиммати :attribute бояд адад бошад.',
    'present'              => 'Қиммати :attribute бояд мавҷуд бошад.',
    'regex'                => 'Формати :attribute нодуруст мебошад.',
    'required'             => ':attribute бояд дорои қиммат бошад.',
    'required_if'          => ':attribute бояд дорои қиммат бошад агар :other ба :value баробар бошад.',
    'required_unless'      => ':attribute бояд дорои қиммат бошад агар :other дар :values мавҷуд бошад.',
    'required_with'        => ':attribute бояд дорои қиммат бошад :values мавҷуд бошад.',
    'required_with_all'    => ':attribute бояд дорои қиммат бошад агар :values мавҷуд бошанд.',
    'required_without'     => ':attribute бояд дорои қиммат бошад агар :values мавҷуд набошад.',
    'required_without_all' => ':attribute бояд дорои қиммат бошад агар ягон :values мавҷуд набошад.',
    'same'                 => 'Қиммати :attribute ва :other бояд баробар бошанд.',
    'size'                 => [
        $str1 => 'Қиммати :attribute бояд ба :size баробар бошад.',
        'file'    => 'Ҳаҷми файл дар :attribute бояд :size Килобайт бошад.',
        $str2 => 'Миқдори аломатҳо дар :attribute бояд :size бошад.',
        $str => 'Миқдори элементҳо дар :attribute бояд :size бошад.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => 'Қиммати :attribute бояд сатр бошад.',
    'timezone'             => 'Қиммати :attribute бояд зонаи дуруст бошад.',
    'unique'               => 'Қиммати :attribute қаблан интихоб шудааст.',
    'uploaded'             => 'Боркунии :attribute ба хатогӣ дучор шуд.',
    'url'                  => 'Формати :attribute нодуруст мебошад.',
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

    'attributes' => [],
];
