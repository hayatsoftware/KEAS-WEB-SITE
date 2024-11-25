<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = 'Der gewählte Wert für :attribute ist ungültig.';
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

    'accepted'             => ':attribute muss akzeptiert werden.',
    'active_url'           => ':attribute ist keine gültige Internet-Adresse.',
    'after'                => ':attribute muss ein Datum nach dem :date sein.',
    'after_or_equal'       => ':attribute muss ein Datum nach dem :date oder gleich dem :date sein.',
    'alpha'                => ':attribute darf nur aus Buchstaben bestehen.',
    'alpha_dash'           => ':attribute darf nur aus Buchstaben, Zahlen, Binde- und Unterstrichen bestehen.',
    'alpha_num'            => ':attribute darf nur aus Buchstaben und Zahlen bestehen.',
    $str => ':attribute muss ein Array sein.',
    'before'               => ':attribute muss ein Datum vor dem :date sein.',
    'before_or_equal'      => ':attribute muss ein Datum vor dem :date oder gleich dem :date sein.',
    'between'              => [
        $str1 => ':attribute muss zwischen :min & :max liegen.',
        'file'    => ':attribute muss zwischen :min & :max Kilobytes gross sein.',
        $str2 => ':attribute muss zwischen :min & :max Zeichen lang sein.',
        $str => ':attribute muss zwischen :min & :max Elemente haben.',
    ],
    'boolean'              => ":attribute muss entweder 'true' oder 'false' sein.",
    'confirmed'            => ':attribute stimmt nicht mit der Bestätigung überein.',
    'date'                 => ':attribute muss ein gültiges Datum sein.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute entspricht nicht dem gültigen Format für :format.',
    'different'            => ':attribute und :other müssen sich unterscheiden.',
    'digits'               => ':attribute muss :digits Stellen haben.',
    'digits_between'       => ':attribute muss zwischen :min und :max Stellen haben.',
    'dimensions'           => ':attribute hat ungültige Bildabmessungen.',
    'distinct'             => ':attribute beinhaltet einen bereits vorhandenen Wert.',
    'email'                => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'exists'               => $str3,
    'file'                 => ':attribute muss eine Datei sein.',
    'filled'               => ':attribute muss ausgefüllt sein.',
    'gt'                   => [
        $str1 => ':attribute muss mindestens :value sein.',
        'file'    => ':attribute muss mindestens :value Kilobytes gross sein.',
        $str2 => ':attribute muss mindestens :value Zeichen lang sein.',
        $str => ':attribute muss mindestens :value Elemente haben.',
    ],
    'gte'                  => [
        $str1 => ':attribute muss grösser oder gleich :value sein.',
        'file'    => ':attribute muss grösser oder gleich :value Kilobytes sein.',
        $str2 => ':attribute muss grösser oder gleich :value Zeichen lang sein.',
        $str => ':attribute muss grösser oder gleich :value Elemente haben.',
    ],
    'image'                => ':attribute muss ein Bild sein.',
    'in'                   => $str3,
    'in_array'             => 'Der gewählte Wert für :attribute kommt nicht in :other vor.',
    'integer'              => ':attribute muss eine ganze Zahl sein.',
    'ip'                   => ':attribute muss eine gültige IP-Adresse sein.',
    'ipv4'                 => ':attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6'                 => ':attribute muss eine gültige IPv6-Adresse sein.',
    'json'                 => ':attribute muss ein gültiger JSON-String sein.',
    'lt'                   => [
        $str1 => ':attribute muss kleiner :value sein.',
        'file'    => ':attribute muss kleiner :value Kilobytes gross sein.',
        $str2 => ':attribute muss kleiner :value Zeichen lang sein.',
        $str => ':attribute muss kleiner :value Elemente haben.',
    ],
    'lte'                  => [
        $str1 => ':attribute muss kleiner oder gleich :value sein.',
        'file'    => ':attribute muss kleiner oder gleich :value Kilobytes sein.',
        $str2 => ':attribute muss kleiner oder gleich :value Zeichen lang sein.',
        $str => ':attribute muss kleiner oder gleich :value Elemente haben.',
    ],
    'max'                  => [
        $str1 => ':attribute darf maximal :max sein.',
        'file'    => ':attribute darf maximal :max Kilobytes gross sein.',
        $str2 => ':attribute darf maximal :max Zeichen haben.',
        $str => ':attribute darf nicht mehr als :max Elemente haben.',
    ],
    'mimes'                => ':attribute muss den Dateityp :values haben.',
    'mimetypes'            => ':attribute muss den Dateityp :values haben.',
    'min'                  => [
        $str1 => ':attribute muss mindestens :min sein.',
        'file'    => ':attribute muss mindestens :min Kilobytes gross sein.',
        $str2 => ':attribute muss mindestens :min Zeichen lang sein.',
        $str => ':attribute muss mindestens :min Elemente haben.',
    ],
    'not_in'               => $str3,
    'not_regex'            => ':attribute hat ein ungültiges Format.',
    $str1 => ':attribute muss eine Zahl sein.',
    'present'              => ':attribute muss vorhanden sein.',
    'regex'                => ':attribute Format ist ungültig.',
    'required'             => ':attribute muss ausgefüllt sein.',
    'required_if'          => ':attribute muss ausgefüllt sein, wenn :other :value ist.',
    'required_unless'      => ':attribute muss ausgefüllt sein, wenn :other nicht :values ist.',
    'required_with'        => ':attribute muss angegeben werden, wenn :values ausgefüllt wurde.',
    'required_with_all'    => ':attribute muss angegeben werden, wenn :values ausgefüllt wurde.',
    'required_without'     => ':attribute muss angegeben werden, wenn :values nicht ausgefüllt wurde.',
    'required_without_all' => ':attribute muss angegeben werden, wenn keines der Felder :values ausgefüllt wurde.',
    'same'                 => ':attribute und :other müssen übereinstimmen.',
    'size'                 => [
        $str1 => ':attribute muss gleich :size sein.',
        'file'    => ':attribute muss :size Kilobyte gross sein.',
        $str2 => ':attribute muss :size Zeichen lang sein.',
        $str => ':attribute muss genau :size Elemente haben.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => ':attribute muss ein String sein.',
    'timezone'             => ':attribute muss eine gültige Zeitzone sein.',
    'unique'               => ':attribute ist schon vergeben.',
    'uploaded'             => ':attribute konnte nicht hochgeladen werden.',
    'url'                  => ':attribute muss eine URL sein.',
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
        'name'                  => 'Name',
        'username'              => 'Benutzername',
        'email'                 => 'E-Mail-Adresse',
        'first_name'            => 'Vorname',
        'last_name'             => 'Nachname',
        'password'              => 'Passwort',
        'password_confirmation' => 'Passwort-Bestätigung',
        'city'                  => 'Stadt',
        'country'               => 'Land',
        'address'               => 'Adresse',
        'phone'                 => 'Telefonnummer',
        'mobile'                => 'Handynummer',
        'age'                   => 'Alter',
        'sex'                   => 'Geschlecht',
        'gender'                => 'Geschlecht',
        'day'                   => 'Tag',
        'month'                 => 'Monat',
        'year'                  => 'Jahr',
        'hour'                  => 'Stunde',
        'minute'                => 'Minute',
        'second'                => 'Sekunde',
        'title'                 => 'Titel',
        'content'               => 'Inhalt',
        'description'           => 'Beschreibung',
        'excerpt'               => 'Auszug',
        'date'                  => 'Datum',
        'time'                  => 'Uhrzeit',
        'available'             => 'verfügbar',
        'size'                  => 'Grösse',
    ],
];
