<?php

$str = 'array';
$str1 = 'file';
$str2 = 'string';
$str3 = 'numeric';
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

    'accepted'             => 'Reiturinn :attribute verður að vera samþykktur.',
    'active_url'           => 'Reiturinn :attribute er ekki leyfileg vefslóð.',
    'after'                => 'Reiturinn :attribute verður að vera dagsetning eftir :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'Reiturinn :attribute má aðeins innihalda bókstafi.',
    'alpha_dash'           => 'Reiturinn :attribute má aðeins innihalda bókstafi, tölur og undirstikanir.',
    'alpha_num'            => 'Reiturinn :attribute má aðeins innihalda bókstafi og tölur.',
    $str => 'Reiturinn :attribute verður að vera fylki.',
    'before'               => 'Reiturinn :attribute verður að vera dagsetning eftir :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        $str3 => 'Reiturinn :attribute verður að vera á milli :min - :max.',
        $str1 => 'Reiturinn :attribute verður að vera á milli :min - :max kílóbæta.',
        $str2 => 'Reiturinn :attribute verður að vera á milli :min - :max stafa.',
        $str => 'Reiturinn :attribute verður að vera á milli :min - :max staka.',
    ],
    'boolean'              => 'Reiturinn :attribute verður að vera réttur eða rangur.',
    'confirmed'            => 'Staðfesting á reitnum :attribute passar ekki.',
    'date'                 => 'Reiturinn :attribute er ekki rétt dagsetning.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => 'Reiturinn :attribute passar ekki við :format.',
    'different'            => 'Reiturinn :attribute og :other verða að vera ólíkir.',
    'digits'               => 'Reiturinn :attribute verður að vera :digits tölustafir.',
    'digits_between'       => 'Reiturinn :attribute verður að vera á milli :min og :max tölustafa.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'Reiturinn :attribute snið netfangsins er ekki rétt.',
    $str1 => 'The :attribute must be a file.',
    'filled'               => 'Reiturinn :attribute verður að innihalda eitthvað.',
    'exists'               => 'Reiturinn :attribute er nú þegar til.',
    'gt'                   => [
        $str3 => 'The :attribute must be greater than :value.',
        $str1 => 'The :attribute must be greater than :value kilobytes.',
        $str2 => 'The :attribute must be greater than :value characters.',
        $str => 'The :attribute must have more than :value items.',
    ],
    'gte'                  => [
        $str3 => 'The :attribute must be greater than or equal :value.',
        $str1 => 'The :attribute must be greater than or equal :value kilobytes.',
        $str2 => 'The :attribute must be greater than or equal :value characters.',
        $str => 'The :attribute must have :value items or more.',
    ],
    'image'                => 'Reiturinn :attribute verður að vera mynd.',
    'in'                   => 'Reiturinn :attribute er ekki réttur.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'Reiturinn :attribute verður að vera tala.',
    'ip'                   => 'Reiturinn :attribute verður að vera lögleg IP-tala.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'lt'                   => [
        $str3 => 'The :attribute must be less than :value.',
        $str1 => 'The :attribute must be less than :value kilobytes.',
        $str2 => 'The :attribute must be less than :value characters.',
        $str => 'The :attribute must have less than :value items.',
    ],
    'lte'                  => [
        $str3 => 'The :attribute must be less than or equal :value.',
        $str1 => 'The :attribute must be less than or equal :value kilobytes.',
        $str2 => 'The :attribute must be less than or equal :value characters.',
        $str => 'The :attribute must not have more than :value items.',
    ],
    'max'                  => [
        $str3 => 'Reiturinn :attribute verður að innihalda færri stafi en :max.',
        $str1 => 'Reiturinn :attribute verður að vera minni en :max kílóbæt.',
        $str2 => 'Reiturinn :attribute verður að innihalda færri en :max stafi.',
        $str => 'Reiturinn :attribute verður að innihalda færri en :max stök.',
    ],
    'mimes'                => 'Reiturinn :attribute verður að vera skrá af gerðinni: :values.',
    'mimetypes'            => 'Reiturinn :attribute verður að vera skrá af gerðinni: :values.',
    'min'                  => [
        $str3 => 'Reiturinn :attribute verður að vera að lágmarki :min tölustafir.',
        $str1 => 'Reiturinn :attribute verður að vera að lágmarki :min kílóbæt.',
        $str2 => 'Reiturinn :attribute verður að vera að lágmarki :min stafir.',
        $str => 'Reiturinn :attribute verður að vera að lágmarki :min stök.',
    ],
    'not_in'               => 'Reiturinn :attribute er ógildur.',
    'not_regex'            => 'The :attribute format is invalid.',
    $str3 => 'Reiturinn :attribute verður að vera tala.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'Reiturinn :attribute er ekki á réttu formi.',
    'required'             => 'Reiturinn :attribute er nauðsynlegur.',
    'required_if'          => 'Reiturinn :attribute er nauðsynlegur þegar :other er :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'Reiturinn :attribute og :other verða að stemma.',
    'size'                 => [
        $str3 => 'Reiturinn :attribute verður að vera :size.',
        $str1 => 'Reiturinn :attribute verður að vera :size kílóbæt.',
        $str2 => 'Reiturinn :attribute verður að vera :size stafir.',
        $str => 'Reiturinn :attribute verður að innihalda :size hluti.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => 'The :attribute must be a string.',
    'timezone'             => 'Reiturinn :attribute verður að vera rétt tímabelti.',
    'unique'               => 'Reiturinn :attribute er því miður ekki leyfilegur. Það er annar eins.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'Reiturinn :attribute verður að vera netslóð.',
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
        'name'                  => 'Nafn',
        'username'              => 'Notendanafn',
        'email'                 => 'Netfang',
        'first_name'            => 'Fornafn',
        'last_name'             => 'Eftirnafn',
        'password'              => 'Lykilorð',
        'password_confirmation' => 'Staðfesting á lykilorði',
        'city'                  => 'Borg',
        'country'               => 'Land',
        'address'               => 'Heimilisfang',
        'phone'                 => 'Heimasími',
        'mobile'                => 'Farsími',
        'age'                   => 'Aldur',
        'sex'                   => 'Sex',
        'gender'                => 'Kyn',
        'day'                   => 'Dagur',
        'month'                 => 'Mánuður',
        'year'                  => 'Ár',
        'hour'                  => 'Klukkutími',
        'minute'                => 'Mínúta',
        'second'                => 'Sekúnda',
        'title'                 => 'Titill',
        'content'               => 'Efni',
        'description'           => 'Lýsing',
        'excerpt'               => 'Excerpt',
        'date'                  => 'Dagsetning',
        'time'                  => 'Tími',
        'available'             => 'Í boði',
        'size'                  => 'Stærð',
    ],
];
