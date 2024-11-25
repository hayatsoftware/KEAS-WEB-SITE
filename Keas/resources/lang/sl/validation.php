<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = 'izbran :attribute je neveljaven.';
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

    'accepted'             => ':attribute mora biti sprejet.',
    'active_url'           => ':attribute ni pravilen.',
    'after'                => ':attribute mora biti za datumom :date.',
    'after_or_equal'       => ':attribute mora biti za ali enak :date.',
    'alpha'                => ':attribute lahko vsebuje samo črke.',
    'alpha_dash'           => ':attribute lahko vsebuje samo črke, številke in črtice.',
    'alpha_num'            => ':attribute lahko vsebuje samo črke in številke.',
    $str => ':attribute mora biti polje.',
    'before'               => ':attribute mora biti pred datumom :date.',
    'before_or_equal'      => ':attribute mora biti pred ali enak :date.',
    'between'              => [
        $str1 => ':attribute mora biti med :min in :max.',
        'file'    => ':attribute mora biti med :min in :max kilobajti.',
        $str2 => ':attribute mora biti med :min in :max znaki.',
        $str => ':attribute mora imeti med :min in :max elementov.',
    ],
    'boolean'              => ':attribute polje mora biti 1 ali 0',
    'confirmed'            => ':attribute potrditev se ne ujema.',
    'date'                 => ':attribute ni veljaven datum.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute se ne ujema z obliko :format.',
    'different'            => ':attribute in :other mora biti drugačen.',
    'digits'               => ':attribute mora imeti :digits cifer.',
    'digits_between'       => ':attribute mora biti med :min in :max ciframi.',
    'dimensions'           => ':attribute ima napačne dimenzije slike.',
    'distinct'             => ':attribute je duplikat.',
    'email'                => ':attribute mora biti veljaven e-poštni naslov.',
    'exists'               => $str3,
    'file'                 => ':attribute mora biti datoteka.',
    'filled'               => ':attribute mora biti izpolnjen.',
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
    'image'                => ':attribute mora biti slika.',
    'in'                   => $str3,
    'in_array'             => ':attribute ne obstaja v :other.',
    'integer'              => ':attribute mora biti število.',
    'ip'                   => ':attribute mora biti veljaven IP naslov.',
    'ipv4'                 => ':attribute mora biti veljaven IPv4 naslov.',
    'ipv6'                 => ':attribute mora biti veljaven IPv6 naslov.',
    'json'                 => ':attribute mora biti veljaven JSON tekst.',
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
        $str1 => ':attribute ne sme biti večje od :max.',
        'file'    => ':attribute ne sme biti večje :max kilobajtov.',
        $str2 => ':attribute ne sme biti večje :max znakov.',
        $str => ':attribute ne smejo imeti več kot :max elementov.',
    ],
    'mimes'                => ':attribute mora biti datoteka tipa: :values.',
    'mimetypes'            => ':attribute mora biti datoteka tipa: :values.',
    'min'                  => [
        $str1 => ':attribute mora biti vsaj dolžine :min.',
        'file'    => ':attribute mora imeti vsaj :min kilobajtov.',
        $str2 => ':attribute mora imeti vsaj :min znakov.',
        $str => ':attribute mora imeti vsaj :min elementov.',
    ],
    'not_in'               => $str3,
    'not_regex'            => 'The :attribute format is invalid.',
    $str1 => ':attribute mora biti število.',
    'present'              => 'Polje :attribute mora biti prisotno.',
    'regex'                => 'Format polja :attribute je neveljaven.',
    'required'             => 'Polje :attribute je obvezno.',
    'required_if'          => 'Polje :attribute je obvezno, če je :other enak :value.',
    'required_unless'      => 'Polje :attribute je obvezno, razen če je :other v :values.',
    'required_with'        => 'Polje :attribute je obvezno, če je :values prisoten.',
    'required_with_all'    => 'Polje :attribute je obvezno, če so :values prisoten.',
    'required_without'     => 'Polje :attribute je obvezno, če :values ni prisoten.',
    'required_without_all' => 'Polje :attribute je obvezno, če :values niso prisotni.',
    'same'                 => 'Polje :attribute in :other se morata ujemati.',
    'size'                 => [
        $str1 => ':attribute mora biti :size.',
        'file'    => ':attribute mora biti :size kilobajtov.',
        $str2 => ':attribute mora biti :size znakov.',
        $str => ':attribute mora vsebovati :size elementov.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => ':attribute mora biti tekst.',
    'timezone'             => ':attribute mora biti časovna cona.',
    'unique'               => ':attribute je že zaseden.',
    'uploaded'             => 'Nalaganje :attribute ni uspelo.',
    'url'                  => ':attribute format je neveljaven.',
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
            'rule-name' => 'Prilagojeno sporočilo',
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
