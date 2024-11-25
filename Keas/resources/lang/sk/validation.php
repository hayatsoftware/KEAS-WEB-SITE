<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = ':Attribute má neplatný formát.';
$str4 = 'označený :attribute je neplatný.';
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

    'accepted'             => ':Attribute musí byť akceptovaný.',
    'active_url'           => ':Attribute má neplatnú URL adresu.',
    'after'                => ':Attribute musí byť dátum po :date.',
    'after_or_equal'       => ':Attribute musí byť dátum po alebo presne :date.',
    'alpha'                => ':Attribute môže obsahovať len písmená.',
    'alpha_dash'           => ':Attribute môže obsahovať len písmená, čísla a pomlčky.',
    'alpha_num'            => ':Attribute môže obsahovať len písmená, čísla.',
    $str => ':Attribute musí byť pole.',
    'before'               => ':Attribute musí byť dátum pred :date.',
    'before_or_equal'      => ':Attribute musí byť dátum pred alebo presne :date.',
    'between'              => [
        $str1 => ':Attribute musí mať rozsah :min - :max.',
        'file'    => ':Attribute musí mať rozsah :min - :max kilobajtov.',
        $str2 => ':Attribute musí mať rozsah :min - :max znakov.',
        $str => ':Attribute musí mať rozsah :min - :max prvkov.',
    ],
    'boolean'              => ':Attribute musí byť pravda alebo nepravda.',
    'confirmed'            => ':Attribute konfirmácia sa nezhoduje.',
    'date'                 => ':Attribute má neplatný dátum.',
    'date_equals'          => ':Attribute musí byť dátum rovnajúci sa :date.',
    'date_format'          => ':Attribute sa nezhoduje s formátom :format.',
    'different'            => ':Attribute a :other musia byť odlišné.',
    'digits'               => ':Attribute musí mať :digits číslic.',
    'digits_between'       => ':Attribute musí mať rozsah :min až :max číslic.',
    'dimensions'           => ':Attribute má neplatné rozmery obrázku.',
    'distinct'             => ':Attribute je duplicitný.',
    'email'                => $str3,
    'exists'               => $str4,
    'file'                 => ':Attribute musí byť súbor.',
    'filled'               => ':Attribute je požadované.',
    'gt'                   => [
        $str1 => 'Hodnota :attribute musí byť väčšia ako :value.',
        'file'    => ':Attribute musí mať viac kilobajtov ako :value.',
        $str2 => ':Attribute musí mať viac znakov ako :value.',
        $str => ':Attribute musí mať viac prvkov ako :value.',
    ],
    'gte'                  => [
        $str1 => 'Hodnota :attribute musí byť väčšia alebo rovná ako :value.',
        'file'    => ':Attribute musí mať rovnaký alebo väčší počet kilobajtov ako :value.',
        $str2 => ':Attribute musí mať rovnaký alebo väčší počet znakov ako :value.',
        $str => ':Attribute musí mať rovnaký alebo väčší počet prvkov ako :value.',
    ],
    'image'                => ':Attribute musí byť obrázok.',
    'in'                   => $str4,
    'in_array'             => ':Attribute sa nenachádza v :other.',
    'integer'              => ':Attribute musí byť celé číslo.',
    'ip'                   => ':Attribute musí byť platná IP adresa.',
    'ipv4'                 => ':Attribute musí byť platná IPv4 adresa.',
    'ipv6'                 => ':Attribute musí byť platná IPv6 adresa.',
    'json'                 => ':Attribute musí byť platný JSON reťazec.',
    'lt'                   => [
        $str1 => 'Hodnota :attribute musí byť menšia ako :value.',
        'file'    => ':Attribute musí mať menej kilobajtov ako :value.',
        $str2 => ':Attribute musí mať menej znakov ako :value.',
        $str => ':Attribute musí mať menej prvkov ako :value.',
    ],
    'lte'                  => [
        $str1 => 'Hodnota :attribute musí byť menšia alebo rovná ako :value.',
        'file'    => ':Attribute musí mať rovnaký alebo menší počet kilobajtov ako :value.',
        $str2 => ':Attribute musí mať rovnaký alebo menší počet znakov ako :value.',
        $str => ':Attribute musí mať rovnaký alebo menší počet prvkov ako :value.',
    ],
    'max'                  => [
        $str1 => ':Attribute nemôže byť väčší ako :max.',
        'file'    => ':Attribute nemôže byť väčší ako :max kilobajtov.',
        $str2 => ':Attribute nemôže byť väčší ako :max znakov.',
        $str => ':Attribute nemôže mať viac ako :max prvkov.',
    ],
    'mimes'                => ':Attribute musí byť súbor s koncovkou: :values.',
    'mimetypes'            => ':Attribute musí byť súbor s koncovkou: :values.',
    'min'                  => [
        $str1 => ':Attribute musí mať aspoň :min.',
        'file'    => ':Attribute musí mať aspoň :min kilobajtov.',
        $str2 => ':Attribute musí mať aspoň :min znakov.',
        $str => ':Attribute musí mať aspoň :min prvkov.',
    ],
    'not_in'               => $str4,
    'not_regex'            => $str3,
    $str1 => ':Attribute musí byť číslo.',
    'present'              => ':Attribute musí byť odoslaný.',
    'regex'                => $str3,
    'required'             => ':Attribute je požadované.',
    'required_if'          => ':Attribute je požadované keď :other je :value.',
    'required_unless'      => ':Attribute je požadované, okrem prípadu keď :other je v :values.',
    'required_with'        => ':Attribute je požadované keď :values je prítomné.',
    'required_with_all'    => ':Attribute je požadované ak :values je nastavené.',
    'required_without'     => ':Attribute je požadované keď :values nie je prítomné.',
    'required_without_all' => ':Attribute je požadované ak žiadne z :values nie je nastavené.',
    'same'                 => ':Attribute a :other sa musia zhodovať.',
    'size'                 => [
        $str1 => ':Attribute musí byť :size.',
        'file'    => ':Attribute musí mať :size kilobajtov.',
        $str2 => ':Attribute musí mať :size znakov.',
        $str => ':Attribute musí obsahovať :size prvkov.',
    ],
    'starts_with'          => ':Attribute musí začínať niektorou z hodnôt: :values',
    $str2 => ':Attribute musí byť reťazec znakov.',
    'timezone'             => ':Attribute musí byť platné časové pásmo.',
    'unique'               => ':Attribute už existuje.',
    'uploaded'             => 'Nepodarilo sa nahrať :attribute.',
    'url'                  => ':Attribute musí mať formát URL.',
    'uuid'                 => ':Attribute musí byť platné UUID.',

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
