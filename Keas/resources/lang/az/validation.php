<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = ' seçilmiş :attribute yanlışdır';
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

    'accepted'             => ':attribute qəbul edilməlidir',
    'active_url'           => ':attribute doğru URL deyil',
    'after'                => ':attribute :date tarixindən sonra olmalıdır',
    'after_or_equal'       => ':attribute :date tarixi ilə eyni və ya sonra olmalıdır',
    'alpha'                => ':attribute yalnız hərflərdən ibarət ola bilər',
    'alpha_dash'           => ':attribute yalnız hərf, rəqəm və tire simvolundan ibarət ola bilər',
    'alpha_num'            => ':attribute yalnız hərf və rəqəmlərdən ibarət ola bilər',
    $str => ':attribute massiv formatında olmalıdır',
    'before'               => ':attribute :date tarixindən əvvəl olmalıdır',
    'before_or_equal'      => ':attribute :date tarixindən əvvəl və ya bərabər olmalıdır',
    'between'              => [
        $str1 => ':attribute :min ilə :max arasında olmalıdır',
        'file'    => ':attribute :min ilə :max KB ölçüsü intervalında olmalıdır',
        $str2 => ':attribute :min ilə :max simvolu intervalında olmalıdır',
        $str => ':attribute :min ilə :max intervalında hissədən ibarət olmalıdır',
    ],
    'boolean'              => ' :attribute doğru və ya yanlış ola bilər',
    'confirmed'            => ' :attribute doğrulanması yanlışdır',
    'date'                 => ' :attribute tarix formatında olmalıdır',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ' :attribute :format formatında olmalıdır',
    'different'            => ' :attribute və :other fərqli olmalıdır',
    'digits'               => ' :attribute :digits rəqəmli olmalıdır',
    'digits_between'       => ' :attribute :min ilə :max rəqəmləri intervalında olmalıdır',
    'dimensions'           => ' :attribute doğru şəkil ölçülərində deyil',
    'distinct'             => ' :attribute dublikat qiymətlidir',
    'email'                => ' :attribute doğru email formatında deyil',
    'exists'               => $str3,
    'file'                 => ' :attribute fayl formatında olmalıdır',
    'filled'               => ' :attribute qiyməti olmalıdır',
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
    'image'                => ' :attribute şəkil formatında olmalıdır',
    'in'                   => $str3,
    'in_array'             => ' :attribute :other qiymətləri arasında olmalıdır',
    'integer'              => ' :attribute tam ədəd olmalıdır',
    'ip'                   => ' :attribute İP adres formatında olmalıdır',
    'ipv4'                 => ' :attribute İPv4 adres formatında olmalıdır',
    'ipv6'                 => ' :attribute İPv6 adres formatında olmalıdır',
    'json'                 => ' :attribute JSON formatında olmalıdır',
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
        $str1 => ' :attribute maksiumum :max rəqəmdən ibarət ola bilər',
        'file'    => ' :attribute maksimum :max KB ölçüsündə ola bilər',
        $str2 => ' :attribute maksimum :max simvoldan ibarət ola bilər',
        $str => ' :attribute maksimum :max hədd\'dən ibarət ola bilər',
    ],
    'mimes'                => ' :attribute :values tipində fayl olmalıdır',
    'mimetypes'            => ' :attribute :values tipində fayl olmalıdır',
    'min'                  => [
        $str1 => ' :attribute minimum :min rəqəmdən ibarət ola bilər',
        'file'    => ' :attribute minimum :min KB ölçüsündə ola bilər',
        $str2 => ' :attribute minimum :min simvoldan ibarət ola bilər',
        $str => ' :attribute minimum :min hədd\'dən ibarət ola bilər',
    ],
    'not_in'               => $str3,
    'not_regex'            => 'The :attribute format is invalid.',
    $str1 => ' :attribute rəqəmlərdən ibarət olmalıdır',
    'present'              => ' :attribute iştirak etməlidir',
    'regex'                => ' :attribute formatı yanlışdır',
    'required'             => ' :attribute mütləqdir',
    'required_if'          => ' :attribute (:other :value ikən) mütləqdir',
    'required_unless'      => ' :attribute (:other :values \'ə daxil ikən) mütləqdir',
    'required_with'        => ' :attribute (:values var ikən) mütləqdir',
    'required_with_all'    => ' :attribute (:values var ikən) mütləqdir',
    'required_without'     => ' :attribute (:values yox ikən) mütləqdir',
    'required_without_all' => ' :attribute (:values yox ikən) mütləqdir',
    'same'                 => ' :attribute və :other eyni olmalıdır',
    'size'                 => [
        $str1 => ' :attribute :size ölçüsündə olmalıdır',
        'file'    => ' :attribute :size KB ölçüsündə olmalıdır',
        $str2 => ' :attribute :size simvoldan ibarət olmalıdır',
        $str => ' :attribute :size hədd\'dən ibarət olmalıdır',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str2 => ' :attribute hərf formatında olmalıdır',
    'timezone'             => ' :attribute ərazi formatında olmalıdır',
    'unique'               => ' :attribute artıq iştirak edib',
    'uploaded'             => ' :attribute yüklənməsi mümkün olmadı',
    'url'                  => ' :attribute formatı yanlışdır',
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

    'attributes' => [],
];
