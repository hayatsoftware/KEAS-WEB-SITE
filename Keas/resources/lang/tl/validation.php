<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = 'Ang :attribute ay dapat balidong email address.';
$str4 = 'Ang piniling :attribute ay imbalido.';
$str5 = 'Ang :attribute ng attribute ay kailangan kapag :values balyu ang naroon.';
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

    'accepted'             => 'Ang :attribute ay dapat tanggapin.',
    'active_url'           => 'Ang :attribute ay hindi balidong URL.',
    'after'                => 'Ang :attribute ay dapat petsa pagkatapos ng :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'Ang :attribute ay maaaring magtaglay ng mga letra lang.',
    'alpha_dash'           => 'Ang :attribute ay maaaring magtaglay ng mga letra, numero at gitling lang.',
    'alpha_num'            => 'Ang :attribute ay maaaring magtaglay ng mga letra at numero lang.',
    $str => 'Ang :attribute ay dapat magkakasunod.',
    'before'               => 'Ang :attribute ay dapat petsa bago ang :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        $str1 => 'Ang :attribute ay dapat nasa pagitan ng :min at :max.',
        'file'    => 'Ang :attribute ay dapat nasa pagitan ng :min at :max kilobytes.',
        $str2 => 'Ang :attribute ay dapat nasa pagitan ng :min at :max characters.',
        $str => 'Ang :attribute ay dapat nasa pagitan ng :min at :max items.',
    ],
    'boolean'              => 'Ang :attribute ng attribute ay dapat tama o mali.',
    'confirmed'            => 'Ang :attribute ng attribute ay hindi magkatugma.',
    'date'                 => 'Ang :attribute ay hindi balidong petsa.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => 'Ang :attribute ay hindi katugma ng format :format.',
    'different'            => 'Ang :attribute at :other pa ay dapat magkaiba.',
    'digits'               => 'Ang :attribute ay dapat :digits digits.',
    'digits_between'       => 'Ang :attribute ay dapat nasa pagitan ng :min at :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'Ang :attribute ng attribute ay may katulad na balyu.',
    'email'                => $str3,
    'exists'               => $str4,
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'Ang :attribute ng attribute ay kailangan.',
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
    'image'                => 'Ang :attribute ay dapat isang imahe.',
    'in'                   => $str4,
    'in_array'             => 'Ang :attribute ng attribute ay wala sa :other.',
    'integer'              => 'Ang :attribute ay dapat isang integer.',
    'ip'                   => 'Ang :attribute ay dapat isang balidong IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'Ang :attribute ay dapat isang balidong JSON string.',
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
        $str1 => 'Ang :attribute ay hindi maaaring higit sa  :max.',
        'file'    => 'Ang :attribute ay hindi maaaring higit sa  :max kilobytes.',
        $str2 => 'Ang :attribute ay hindi maaaring higit sa :max characters.',
        $str => 'Ang :attribute ay hindi maaaring higit sa :max items.',
    ],
    'mimes'                => 'Ang :attribute ay dapat file ng uri na: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        $str1 => 'Ang :attribute ay dapat di-kukulangin sa :min.',
        'file'    => 'Ang :attribute ay dapat di-kukulangin sa :min kilobytes.',
        $str2 => 'Ang :attribute ay dapat di-kukulangin sa :min characters.',
        $str => 'Ang :attribute ay dapat di-kukulangin sa :min items.',
    ],
    'not_in'               => $str4,
    'not_regex'            => 'The :attribute format is invalid.',
    $str1 => 'Ang :attribute ay dapat isang numero.',
    'present'              => 'Ang :attribute ng attribute ay dapat naroon.',
    'regex'                => 'Ang :attribute ng attribute ay imbalido.',
    'required'             => 'Ang :attribute ng attribute ay kailangan.',
    'required_if'          => 'Ang :attribute ng attribute ay kailangan kapag :other iba ay :value.',
    'required_unless'      => 'Ang :attribute ng attribute ay kailangan maliban kung :other iba ay nasa :values.',
    'required_with'        => $str5,
    'required_with_all'    => $str5,
    'required_without'     => $str5,
    'required_without_all' => 'Ang :attribute ng attribute ay kailangan kapag wala sa :values balyu ang naroon.',
    'same'                 => 'Ang :attribute at :other pa ay dapat magtugma.',
    'size'                 => [
        $str1 => 'Ang :attribute ay dapat :size sukat.',
        'file'    => 'Ang :attribute ay dapat :size sukat sa kilobytes.',
        $str2 => 'Ang :attribute ay dapat :size sukat sa characters.',
        $str => 'Ang :attribute ay dapat magtaglay ng :size sa items.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => 'Ang  :attribute ay dapat isang string.',
    'timezone'             => 'Ang :attribute ay dapat isang balidong sona.',
    'unique'               => 'Ang :attribute ay nakuha na.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'Ang :attribute ng attribute ay imbalido.',
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
            'rule-name' => 'pasadyang-mensahe',
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
        'test_name'               => 'Subok na pangalan',
        'test_description'        => 'Subok na paglalarawan',
        'test_locale'             => 'Wika',
        'image'                   => 'Imahe',
        'result_text_under_image' => 'Resultang teksto sa ilalim ng imahe',
        'short_text'              => 'Maikling teksto',
    ],
];
