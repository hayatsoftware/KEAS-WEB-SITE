<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = ':attribute baliogabea da.';
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

    'accepted'             => ':attribute onartu beharra dago.',
    'active_url'           => ':attribute ez da baliozko URL bat.',
    'after'                => ':attribute :date osteko data izan behar da.',
    'after_or_equal'       => ':attribute :date osteko data edo data bera izan behar da.',
    'alpha'                => ':attribute hizkiak besterik ezin ditu izan.',
    'alpha_dash'           => ':attribute hizkiak, zenbakiak eta marrak besterik ezin ditu izan.',
    'alpha_num'            => ':attribute hizkiak eta zenbakiak besterik ezin ditu izan.',
    $str => ':attribute bilduma izan behar da.',
    'before'               => ':attribute :date aurreko data izan behar da.',
    'before_or_equal'      => ':attribute :date aurreko data edo data bera izan behar da.',
    'between'              => [
        $str1 => ':attribute :min eta :max artean egon behar da.',
        'file'    => ':attribute-(e)k :min eta :max kilobyte arteko pisua izan behar du.',
        $str2 => ':attribute-(e)k :min eta :max karaktere artean izan behar ditu.',
        $str => ':attribute-(e)k :min eta :max arteko elementu kopurua izan behar du.',
    ],
    'boolean'              => ':attribute-(r)en balioa egia edo gezurra izan behar da.',
    'confirmed'            => ':attribute-(r)en berrespena ez dator bat.',
    'date'                 => ':attribute ez da baliozko data.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute datak ez du :format formatua.',
    'different'            => ':attribute eta :other ezberdinak izan behar dira.',
    'digits'               => ':attribute-(e)k :digits digitu eduki behar ditu.',
    'digits_between'       => ':attribute-(e)k :min eta :max arteko digitu kopurua eduki behar du.',
    'dimensions'           => ':attribute irudiaren neurriak baliogabeak dira.',
    'distinct'             => ':attribute-(e)k bikoiztutako balioa dauka.',
    'email'                => ':attribute baliozko helbide elektronikoa izan behar da.',
    'exists'               => $str3,
    'file'                 => ':attribute fitxategi bat izan behar da.',
    'filled'               => ':attribute derrigorrezkoa da.',
    'gt'                   => [
        $str1 => ':attribute-(e)k :value baino handiagoa izan behar du.',
        'file'    => ':attribute-(e)k :value kilobyte baino handiagoa izan behar du.',
        $str2 => ':attribute-(e)k :value karaktere baino gehiago izan behar ditu.',
        $str => ':attribute-(e)k :value elementu baino gehiago izan behar ditu.',
    ],
    'gte'                  => [
        $str1 => ':attribute-(e)k :value baino handiagoa edo berdina izan behar du.',
        'file'    => ':attribute-(e)k :value kilobyte edo gehiago izan behar ditu.',
        $str2 => ':attribute-(e)k :value karaktere edo gehiago izan behar ditu.',
        $str => ':attribute-(e)k :value elementu edo gehiago izan behar ditu.',
    ],
    'image'                => ':attribute irudi bat izan behar da.',
    'in'                   => $str3,
    'in_array'             => ':attribute ez da existizen :other-(e)n.',
    'integer'              => ':attribute zenbaki osoa izan behar da.',
    'ip'                   => ':attribute baliozko IP helbidea izan behar da.',
    'ipv4'                 => ':attribute baliozko IPv4 helbidea izan behar da.',
    'ipv6'                 => ':attribute baliozko IPv6 helbidea izan behar da.',
    'json'                 => ':attribute baliozko JSON karaktere-katea izan behar da.',
    'lt'                   => [
        $str1 => ':attribute-(e)k :value baino txikiagoa izan behar du.',
        'file'    => ':attribute-(e)k :value kilobyte baino txikiagoa izan behar du.',
        $str2 => ':attribute-(e)k :value karaktere baino gutxiago izan behar ditu.',
        $str => ':attribute-(e)k :value elementu baino gutxiago izan behar ditu.',
    ],
    'lte'                  => [
        $str1 => ':attribute-(e)k :value baino txikiagoa edo berdina izan behar du.',
        'file'    => ':attribute-(e)k :value kilobyte edo gutxiago izan behar ditu.',
        $str2 => ':attribute-(e)k :value karaktere edo gutxiago izan behar ditu.',
        $str => ':attribute-(e)k :value elementu edo gutxiago izan behar ditu.',
    ],
    'max'                  => [
        $str1 => ':attribute ezin da :max baino handiagoa izan.',
        'file'    => ':attribute ezin da :max kilobyte baino handiagoa izan.',
        $str2 => ':attribute-(e)k ezin du :max karaktere baino gehiago eduki.',
        $str => ':attribute-(e)k ezin du :max elementu baino gehiago eduki.',
    ],
    'mimes'                => ':attribute :values motako fitxategia izan behar da.',
    'mimetypes'            => ':attribute :values motako fitxategia izan behar da.',
    'min'                  => [
        $str1 => ':attribute-(e)k gutxienez :min-(e)ko tamaina izan behar du.',
        'file'    => ':attribute-(e)k gutxienez :min kilobyte izan behar ditu.',
        $str2 => ':attribute-(e)k gutxienez :min karaktere izan behar ditu.',
        $str => ':attribute-(e)k gutxienez :min elementu izan behar ditu.',
    ],
    'not_in'               => $str3,
    'not_regex'            => ':attribute formatua baliogabea da.',
    $str1 => ':attribute zenbakizkoa izan behar da.',
    'present'              => ':attribute ezin da hutsik egon.',
    'regex'                => $str3,
    'required'             => ':attribute derrigorrezkoa da.',
    'required_if'          => ':attribute derrigorrezkoa da :other :value denean.',
    'required_unless'      => ':attribute derrigorrezkoa da :other :values-(e)n egon ezean.',
    'required_with'        => ':attribute derrigorrezkoa da :values dagoenean.',
    'required_with_all'    => ':attribute derrigorrezkoa da :values daudenean.',
    'required_without'     => ':attribute derrigorrezkoa da :values ez dagoenean.',
    'required_without_all' => ':attribute derrigorrezkoa da :values ez daudenean.',
    'same'                 => ':attribute eta :other bat etorri behar dira.',
    'size'                 => [
        $str1 => ':attribute-(e)k :size tamaina izan behar du.',
        'file'    => ':attribute-(e)k :size kilobyte izan behar behar ditu.',
        $str2 => ':attribute-(e)k :size karaktere izan behar ditu.',
        $str => ':attribute-(e)k :size elementu izan behar ditu.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => ':attribute karaktere-katea izan behar da.',
    'timezone'             => ':attribute baliozko ordu-eremua izan behar da.',
    'unique'               => ':attribute jadanik erregistratua izan da.',
    'uploaded'             => ':attribute kargatzerakoan huts egin du.',
    'url'                  => ':attribute-(r)en formatua baliogabea da.',
    'uuid'                 => ':attribute-(e)k baliozko UUIDa izan behar du.',

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
        'name'                  => 'izena',
        'username'              => 'erabiltzailea',
        'email'                 => 'posta elektronikoa',
        'first_name'            => 'izena',
        'last_name'             => 'abizena',
        'password'              => 'pasahitza',
        'password_confirmation' => 'pasahitzaren berrespena',
        'city'                  => 'hiria',
        'country'               => 'herrialdea',
        'address'               => 'helbidea',
        'phone'                 => 'telefonoa',
        'mobile'                => 'mugikorra',
        'age'                   => 'adina',
        'sex'                   => 'sexua',
        'gender'                => 'generoa',
        'year'                  => 'urtea',
        'month'                 => 'hilabetea',
        'day'                   => 'eguna',
        'hour'                  => 'ordua',
        'minute'                => 'minutua',
        'second'                => 'segundoa',
        'title'                 => 'izenburua',
        'content'               => 'edukia',
        'body'                  => 'gorputza',
        'description'           => 'deskribapena',
        'excerpt'               => 'pasartea',
        'date'                  => 'data',
        'time'                  => 'denbora',
        'subject'               => 'gaia',
        'message'               => 'mezua',
        'available'             => 'erabilgarria',
        'size'                  => 'neurria',
    ],
];
