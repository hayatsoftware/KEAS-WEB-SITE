<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = ':attribute musí být vyplněno.';
$str4 = 'Velikost souboru :attribute musí být menší než :value kB.';
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

    'accepted'             => ':attribute musí být přijat.',
    'active_url'           => ':attribute není platnou URL adresou.',
    'after'                => ':attribute musí být datum po :date.',
    'after_or_equal'       => ':attribute musí být datum :date nebo pozdější.',
    'alpha'                => ':attribute může obsahovat pouze písmena.',
    'alpha_dash'           => ':attribute může obsahovat pouze písmena, číslice, pomlčky a podtržítka. České znaky (á, é, í, ó, ú, ů, ž, š, č, ř, ď, ť, ň) nejsou podporovány.',
    'alpha_num'            => ':attribute může obsahovat pouze písmena a číslice.',
    $str => ':attribute musí být pole.',
    'before'               => ':attribute musí být datum před :date.',
    'before_or_equal'      => 'Datum :attribute musí být před nebo rovno :date.',
    'between'              => [
        $str1 => ':attribute musí být hodnota mezi :min a :max.',
        'file'    => ':attribute musí být větší než :min a menší než :max Kilobytů.',
        $str2 => ':attribute musí být delší než :min a kratší než :max znaků.',
        $str => ':attribute musí obsahovat nejméně :min a nesmí obsahovat více než :max prvků.',
    ],
    'boolean'              => ':attribute musí být true nebo false',
    'confirmed'            => ':attribute nesouhlasí.',
    'date'                 => ':attribute musí být platné datum.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute není platný formát data podle :format.',
    'different'            => ':attribute a :other se musí lišit.',
    'digits'               => ':attribute musí být :digits pozic dlouhé.',
    'digits_between'       => ':attribute musí být dlouhé nejméně :min a nejvíce :max pozic.',
    'dimensions'           => ':attribute má neplatné rozměry.',
    'distinct'             => ':attribute má duplicitní hodnotu.',
    'email'                => ':attribute není platný formát.',
    'exists'               => 'Zvolená hodnota pro :attribute není platná.',
    'file'                 => ':attribute musí být soubor.',
    'filled'               => $str3,
    'gt'                   => [
        $str1 => ':attribute musí být větší než :value.',
        'file'    => 'Velikost souboru :attribute musí být větší než :value kB.',
        $str2 => 'Počet znaků :attribute musí být větší :value.',
        $str => 'Pole :attribute musí mít více prvků než :value.',
    ],
    'gte'                  => [
        $str1 => ':attribute musí být větší nebo rovno :value.',
        'file'    => 'Velikost souboru :attribute musí být větší nebo rovno :value kB.',
        $str2 => 'Počet znaků :attribute musí být větší nebo rovno :value.',
        $str => 'Pole :attribute musí mít :value prvků nebo více.',
    ],
    'image'                => ':attribute musí být obrázek.',
    'in'                   => 'Zvolená hodnota pro :attribute je neplatná.',
    'in_array'             => ':attribute není obsažen v :other.',
    'integer'              => ':attribute musí být celé číslo.',
    'ip'                   => ':attribute musí být platnou IP adresou.',
    'ipv4'                 => ':attribute musí být platná IPv4 adresa.',
    'ipv6'                 => ':attribute musí být platná IPv6 adresa.',
    'json'                 => ':attribute musí být platný JSON řetězec.',
    'lt'                   => [
        $str1 => ':attribute musí být menší než :value.',
        'file'    => $str4,
        $str2 => ':attribute musí obsahovat méně než :value znaků.',
        $str => ':attribute by měl obsahovat méně než :value položek.',
    ],
    'lte'                  => [
        $str1 => ':attribute musí být menší nebo rovno než :value.',
        'file'    => $str4,
        $str2 => ':attribute nesmí být delší než :value znaků.',
        $str => ':attribute by měl obsahovat maximálně :value položek.',
    ],
    'max'                  => [
        $str1 => ':attribute nemůže být větší než :max.',
        'file'    => $str4,
        $str2 => ':attribute nemůže být delší než :max znaků.',
        $str => ':attribute nemůže obsahovat více než :max prvků.',
    ],
    'mimes'                => ':attribute musí být jeden z následujících datových typů :values.',
    'mimetypes'            => ':attribute musí být jeden z následujících datových typů :values.',
    'min'                  => [
        $str1 => ':attribute musí být alespoň :min.',
        'file'    => ':attribute musí mít alespoň :min kB.',
        $str2 => ':attribute musí mít délku alespoň :min znaků.',
        $str => ':attribute musí obsahovat alespoň :min prvků.',
    ],
    'not_in'               => 'Zvolená hodnota pro :attribute je neplatná.',
    'not_regex'            => ':attribute musí být regulární výraz.',
    $str1 => ':attribute musí být číslo.',
    'present'              => $str3,
    'regex'                => ':attribute nemá správný formát.',
    'required'             => $str3,
    'required_if'          => ':attribute musí být vyplněno pokud :other je :value.',
    'required_unless'      => ':attribute musí být vyplněno dokud :other je v :values.',
    'required_with'        => ':attribute musí být vyplněno pokud :values je vyplněno.',
    'required_with_all'    => ':attribute musí být vyplněno pokud :values je zvoleno.',
    'required_without'     => ':attribute musí být vyplněno pokud :values není vyplněno.',
    'required_without_all' => ':attribute musí být vyplněno pokud není žádné z :values zvoleno.',
    'same'                 => ':attribute a :other se musí shodovat.',
    'size'                 => [
        $str1 => ':attribute musí být přesně :size.',
        'file'    => ':attribute musí mít přesně :size Kilobytů.',
        $str2 => ':attribute musí být přesně :size znaků dlouhý.',
        $str => ':attribute musí obsahovat právě :size prvků.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => ':attribute musí být řetězec znaků.',
    'timezone'             => ':attribute musí být platná časová zóna.',
    'unique'               => ':attribute musí být unikátní.',
    'uploaded'             => 'Nahrávání :attribute se nezdařilo.',
    'url'                  => 'Formát :attribute je neplatný.',
    'uuid'                 => ':attribute musí být validní UUID.',

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
        'password' => 'heslo',
    ],
];
