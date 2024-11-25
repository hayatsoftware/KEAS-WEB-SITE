<?php

$str = 'array';
$str1 = 'string';
$str2 = 'numeric';
$str3 = 'Odabrano polje :attribute nije ispravno.';
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

    'accepted'             => 'Polje :attribute mora biti prihvaćeno.',
    'active_url'           => 'Polje :attribute nije ispravan URL.',
    'after'                => 'Polje :attribute mora biti datum nakon :date.',
    'after_or_equal'       => 'Polje :attribute mora biti datum veći ili jednak :date.',
    'alpha'                => 'Polje :attribute smije sadržavati samo slova.',
    'alpha_dash'           => 'Polje :attribute smije sadržavati samo slova, brojeve i crtice.',
    'alpha_num'            => 'Polje :attribute smije sadržavati samo slova i brojeve.',
    $str => 'Polje :attribute mora biti niz.',
    'before'               => 'Polje :attribute mora biti datum prije :date.',
    'before_or_equal'      => 'Polje :attribute mora biti datum manji ili jednak :date.',
    'between'              => [
        $str2 => 'Polje :attribute mora biti između :min - :max.',
        'file'    => 'Polje :attribute mora biti između :min - :max kilobajta.',
        $str1 => 'Polje :attribute mora biti između :min - :max znakova.',
        $str => 'Polje :attribute mora imati između :min - :max stavki.',
    ],
    'boolean'              => 'Polje :attribute mora biti false ili true.',
    'confirmed'            => 'Potvrda polja :attribute se ne podudara.',
    'date'                 => 'Polje :attribute nije ispravan datum.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => 'Polje :attribute ne podudara s formatom :format.',
    'different'            => 'Polja :attribute i :other moraju biti različita.',
    'digits'               => 'Polje :attribute mora sadržavati :digits znamenki.',
    'digits_between'       => 'Polje :attribute mora imati između :min i :max znamenki.',
    'dimensions'           => 'Polje :attribute ima neispravne dimenzije slike.',
    'distinct'             => 'Polje :attribute ima dupliciranu vrijednost.',
    'email'                => 'Polje :attribute mora biti ispravna e-mail adresa.',
    'exists'               => $str3,
    'file'                 => 'Polje :attribute mora biti datoteka.',
    'filled'               => 'Polje :attribute je obavezno.',
    'gt'                   => [
        $str2 => 'Polje :attribute mora biti veće od :value.',
        'file'    => 'Polje :attribute mora biti veće od :value kilobajta.',
        $str1 => 'Polje :attribute mora biti veće od :value karaktera.',
        $str => 'Polje :attribute mora biti veće od :value stavki.',
    ],
    'gte'                  => [
        $str2 => 'Polje :attribute mora biti veće ili jednako :value.',
        'file'    => 'Polje :attribute mora biti veće ili jednako :value kilobajta.',
        $str1 => 'Polje :attribute mora biti veće ili jednako :value znakova.',
        $str => 'Polje :attribute mora imati :value stavki ili više.',
    ],
    'image'                => 'Polje :attribute mora biti slika.',
    'in'                   => $str3,
    'in_array'             => 'Polje :attribute ne postoji u :other.',
    'integer'              => 'Polje :attribute mora biti broj.',
    'ip'                   => 'Polje :attribute mora biti ispravna IP adresa.',
    'ipv4'                 => 'Polje :attribute mora biti ispravna IPv4 adresa.',
    'ipv6'                 => 'Polje :attribute mora biti ispravna IPv6 adresa.',
    'json'                 => 'Polje :attribute mora biti ispravan JSON string.',
    'lt'                   => [
        $str2 => 'Polje :attribute mora biti manje od :value.',
        'file'    => 'Polje :attribute mora biti manje od :value kilobajta.',
        $str1 => 'Polje :attribute mora biti manje od :value znakova.',
        $str => 'Polje :attribute mora biti manje od :value stavki.',
    ],
    'lte'                  => [
        $str2 => 'Polje :attribute mora biti manje ili jednako :value.',
        'file'    => 'Polje :attribute mora biti manje ili jednako :value kilobajta.',
        $str1 => 'Polje :attribute mora biti manje ili jednako :value znakova.',
        $str => 'Polje :attribute ne smije imati više od :value stavki.',
    ],
    'max'                  => [
        $str2 => 'Polje :attribute mora biti manje od :max.',
        'file'    => 'Polje :attribute mora biti manje od :max kilobajta.',
        $str1 => 'Polje :attribute mora sadržavati manje od :max znakova.',
        $str => 'Polje :attribute ne smije imati više od :max stavki.',
    ],
    'mimes'                => 'Polje :attribute mora biti datoteka tipa: :values.',
    'mimetypes'            => 'Polje :attribute mora biti datoteka tipa: :values.',
    'min'                  => [
        $str2 => 'Polje :attribute mora biti najmanje :min.',
        'file'    => 'Polje :attribute mora biti najmanje :min kilobajta.',
        $str1 => 'Polje :attribute mora sadržavati najmanje :min znakova.',
        $str => 'Polje :attribute mora sadržavati najmanje :min stavki.',
    ],
    'not_in'               => $str3,
    'not_regex'            => 'Format polja :attribute je neispravan.',
    $str2 => 'Polje :attribute mora biti broj.',
    'present'              => 'Polje :attribute mora biti prisutno.',
    'regex'                => 'Polje :attribute se ne podudara s formatom.',
    'required'             => 'Polje :attribute je obavezno.',
    'required_if'          => 'Polje :attribute je obavezno kada polje :other sadrži :value.',
    'required_unless'      => 'Polje :attribute je obavezno osim :other je u :values.',
    'required_with'        => 'Polje :attribute je obavezno kada postoji polje :values.',
    'required_with_all'    => 'Polje :attribute je obavezno kada postje polja :values.',
    'required_without'     => 'Polje :attribute je obavezno kada ne postoji polje :values.',
    'required_without_all' => 'Polje :attribute je obavezno kada nijedno od polja :values ne postoji.',
    'same'                 => 'Polja :attribute i :other se moraju podudarati.',
    'size'                 => [
        $str2 => 'Polje :attribute mora biti :size.',
        'file'    => 'Polje :attribute mora biti :size kilobajta.',
        $str1 => 'Polje :attribute mora biti :size znakova.',
        $str => 'Polje :attribute mora sadržavati :size stavki.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str1 => 'Polje :attribute mora biti string.',
    'timezone'             => 'Polje :attribute mora biti ispravna vremenska zona.',
    'unique'               => 'Polje :attribute već postoji.',
    'uploaded'             => 'Polje :attribute nije uspešno učitano.',
    'url'                  => 'Polje :attribute nije ispravnog formata.',
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
