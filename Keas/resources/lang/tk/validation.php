<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = ':attribute formaty ýalňyş.';
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

    'accepted'             => ':attribute kabul edilmelidir.',
    'active_url'           => ':attribute dogry URL bolmalydyr.',
    'after'                => ':attribute şundan has köne sene bolmalydyr :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => ':attribute dine harplardan durmalydyr.',
    'alpha_dash'           => ':attribute dine harplardan, sanlardan we tirelerden durmalydyr.',
    'alpha_num'            => ':attribute dine harplardan we sanlardan durmalydyr.',
    $str => ':attribute ýygyndy bolmalydyr.',
    'before'               => ':attribute şundan has irki sene bolmalydyr :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        $str1 => ':attribute :min - :max arasynda bolmalydyr.',
        'file'    => ':attribute :min - :max kilobaýt arasynda bolmalydyr.',
        $str2 => ':attribute :min - :max harplar arasynda bolmalydyr.',
        $str => ':attribute :min - :max arasynda madda eýe bolmalydyr.',
    ],
    'boolean'              => ':attribute diňe dogry ýada ýalňyş bolmalydyr.',
    'confirmed'            => ':attribute tassyklamasy deň däl.',
    'date'                 => ':attribute dogry sene bolmalydyr.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute :format formatyna deň däl.',
    'different'            => ':attribute bilen :other birbirinden tapawutly bolmalydyr.',
    'digits'               => ':attribute :digits san bolmalydyr.',
    'digits_between'       => ':attribute :min bilen :max arasynda san bolmalydyr.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => $str3,
    'exists'               => 'Saýlanan :attribute ýalňyş.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => ':attribute meýdany zerur.',
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
    'image'                => ':attribute surat bolmalydyr.',
    'in'                   => ':attribute mukdary ýalňyş.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => ':attribute san bolmalydyr.',
    'ip'                   => ':attribute dogry IP adres bolmalydyr.',
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
        $str1 => ':attribute :max den kiçi bolmalydyr.',
        'file'    => ':attribute :max kilobaýtdan kiçi bolmalydyr.',
        $str2 => ':attribute :max harpdan kiçi bolmalydyr.',
        $str => ':attribute iň az :max maddadan ybarat bolmalydyr.',
    ],
    'mimes'                => ':attribute faýlň formaty :values bolmalydyr.',
    'mimetypes'            => ':attribute faýlň formaty :values bolmalydyr.',
    'min'                  => [
        $str1 => ':attribute mukdary :min dan köp bolmalydyr.',
        'file'    => ':attribute mukdary :min kilobaýtdan köp bolmalydyr.',
        $str2 => ':attribute mukdary :min harpdan köp bolmalydyr.',
        $str => ':attribute iň az :min harpdan bolmalydyr.',
    ],
    'not_in'               => 'Saýlanan :attribute geçersiz.',
    'not_regex'            => 'The :attribute format is invalid.',
    $str1 => ':attribute san bolmalydyr.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => $str3,
    'required'             => ':attribute meýdany zerur.',
    'required_if'          => ':attribute meýdany, :other :value hümmetine eýe bolanynda zerurdyr.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => ':attribute meýdany :values bar bolanda zerurdyr.',
    'required_with_all'    => ':attribute meýdany haýsyda bolsa bir :values bar bolanda zerurdyr.',
    'required_without'     => ':attribute meýdany :values ýok bolanda zerurdyr.',
    'required_without_all' => ':attribute meýdany :values dan haýsyda bolsa biri ýok bolanda zerurdyr.',
    'same'                 => ':attribute bilen :other deň bolmalydyr.',
    'size'                 => [
        $str1 => ':attribute :size sandan ybarat bolmalydyr.',
        'file'    => ':attribute :size kilobaýt bolmalydyr.',
        $str2 => ':attribute :size harp bolmalydyr.',
        $str => ':attribute :size madda eýe bolmalydyr.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => 'The :attribute must be a string.',
    'timezone'             => ':attribute dogry zolak bolmalydyr.',
    'unique'               => ':attribute önden hasaba alyndy.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => $str3,
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
