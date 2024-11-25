<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = 'Kipengele kilichochaguliwa si halali.';
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

    'accepted'             => 'Lazima kipengele kikubalike.',
    'active_url'           => 'Kipengele sio Chanzo Cha Anuani halali.',
    'after'                => 'Kipengele lazima kiwe tarehe baada ya :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'Kipengele huenda kikawa tu chenye herufi.',
    'alpha_dash'           => 'Kipengele huenda kikawa tu chenye herufi, na vistari.',
    'alpha_num'            => 'Kipengele huenda kikawa tu chenye herufi na nambari.',
    $str => 'Kipengele lazima kiwe safu.',
    'before'               => 'Kipengele lazima kiwe tarehe kabla ya :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        $str1 => 'Kipengele lazima kiwe kati ya :min na :max.',
        'file'    => 'Kipengele lazima kiwe kati ya :min na :max cha kilobaiti.',
        $str2 => 'Kipengele lazima kiwe kati ya :min na :max cha herufi.',
        $str => 'Kipengele lazima kiwe na kati ya :min na :max cha vifungu.',
    ],
    'boolean'              => 'Sehemu ya kipengele lazima iwe kweli au si kweli.',
    'confirmed'            => 'Uthibitisho wa kipengele haulingani.',
    'date'                 => 'Kipengele si tarehe halali.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => 'Kipengele hakilingani na muundo :date.',
    'different'            => 'Kipengele na :other lazima viwe tofauti.',
    'digits'               => 'Kipengele lazima kiwe :digits tarakimu.',
    'digits_between'       => 'Kipengele lazima kiwe kati ya :min na :max cha tarakimu.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'Sehemu ya kipengele ina thamani rudufu.',
    'email'                => 'Kipengele lazima kiwe anuani halali ya barua pepe.',
    'exists'               => $str3,
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'Sehemu ya kipengele inahitajika.',
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
    'image'                => 'Kipengele lazima kiwe picha.',
    'in'                   => $str3,
    'in_array'             => 'Sehemu ya kipengele haipo katika :other.',
    'integer'              => 'Kipengele lazima kiwe nambari kamili.',
    'ip'                   => 'Kipengele lazima kiwe anuani halali ya Itifaki ya Intaneti.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'Kipengele lazima kiwe kidwe halali cha Nukuu ya Java.',
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
        $str1 => 'Kipengele huenda si kikubwa kuliko :max.',
        'file'    => 'Kipengele huenda si kikubwa kuliko :max cha kilobaiti.',
        $str2 => 'Kipengele huenda si kikubwa kuliko :max cha herufi.',
        $str => 'Kipengele huenda kisiwe na zaidi ya :max cha vifungu.',
    ],
    'mimes'                => 'Kipengele lazima kiwe faili ya aina: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        $str1 => 'Kipengele lazima kiwe angalau :min.',
        'file'    => 'Kipengele lazima kiwe angalau :min cha kilobaiti.',
        $str2 => 'Kipengele lazima kiwe angalau :min cha herufi.',
        $str => 'Kipengele lazima kiwe na angalau :min cha vifungu.',
    ],
    'not_in'               => $str3,
    'not_regex'            => 'The :attribute format is invalid.',
    $str1 => 'Kipengele lazima kiwe nambari.',
    'present'              => 'Sehemu ya kipengele lazima iwepo.',
    'regex'                => 'Muundo wa kipengele si halali.',
    'required'             => 'Sehemu ya kipengele inahitajika.',
    'required_if'          => 'Sehemu ya kipengele inahitajika wakati :other ni :value.',
    'required_unless'      => 'Sehemu ya kipengele inahitajika isipokuwa :other ni katika :values.',
    'required_with'        => 'Sehemu ya kipengele inahitajika wakati :values vipo.',
    'required_with_all'    => 'Sehemu ya kipengele inahitajika wakati :values vipo.',
    'required_without'     => 'Sehemu ya kipengele inahitajika wakati :values havipo.',
    'required_without_all' => 'Sehemu ya kipengele inahitajika wakati hakuna hata moja ya :values ipo.',
    'same'                 => 'Kipengele na :other lazima vilingane.',
    'size'                 => [
        $str1 => 'Kipengele lazima kiwe :size.',
        'file'    => 'Kipengele lazima kiwe :size cha kilobaiti.',
        $str2 => 'Kipengele lazima kiwe :size cha herufi.',
        $str => 'Kipengele lazima kiwe chenye :size vya kipimo.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => 'Kipengele lazima kiwe kidwe.',
    'timezone'             => 'Kipengele lazima kiwe ukanda halali.',
    'unique'               => 'Kipengele tayari kimechukuliwa.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'Muundo wa kipengele si halali.',
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
            'rule-name' => 'ujumbe wa desturi',
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
        'test_name'               => 'Jina la jaribio',
        'test_description'        => 'Maelezo ya jaribio',
        'test_locale'             => 'Lugha',
        'image'                   => 'Picha',
        'result_text_under_image' => 'Maandishi ya matokeo chini ya picha',
        'short_text'              => 'Maandishi mafupi',
    ],
];
