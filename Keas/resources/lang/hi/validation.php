<?php

$str = 'array';
$str1 = 'string';
$str2 = 'numeric';
$str3 = 'चुना गया :attribute अमान्य है।';
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

    'accepted'             => ':attribute को स्वीकार किया जाना चाहिए।',
    'active_url'           => ':attribute एक मान्य URL नहीं है।',
    'after'                => ':attribute, :date के बाद की एक तारीख होनी चाहिए।',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => ':attribute में केवल अक्षर हो सकते हैं।',
    'alpha_dash'           => ':attribute में केवल अक्षर, संख्या, और डैश हो सकते हैं।',
    'alpha_num'            => ':attribute में केवल अक्षर और संख्याएं हो सकती हैं।',
    $str => ':attribute एक सरणी होनी चाहिए।',
    'before'               => ':attribute, :date से पहले की एक तारीख होनी चाहिए।',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        $str2 => ':attribute, :min और :max के बीच होना चाहिए।',
        'file'    => ':attribute, :min और :max किलोबाइट के बीच होना चाहिए।',
        $str1 => ':attribute, :min और :max वर्णों के बीच होना चाहिए।',
        $str => ':attribute, :min और :max आइटमों के बीच होनी चाहिए।',
    ],
    'boolean'              => ':attribute फील्ड सही या गलत होना चाहिए।',
    'confirmed'            => ':attribute पुष्टिकरण मेल नहीं खा रहा है।',
    'date'                 => ':attribute एक मान्य दिनांक नहीं है।',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute फॉर्मेट :format से मेल नहीं खा रहा है।',
    'different'            => ':attribute और :other अलग होना चाहिए।',
    'digits'               => ':attribute, :digits अंक होना चाहिए।',
    'digits_between'       => ':attribute, :min और :max अंकों के बीच होना चाहिए।',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => ':attribute फील्ड का एक डुप्लिकेट मान होता है।',
    'email'                => ':attribute एक मान्य ईमेल पता होना चाहिए।',
    'exists'               => $str3,
    'file'                 => 'The :attribute must be a file.',
    'filled'               => ':attribute फील्ड आवश्यक होता है।',
    'gt'                   => [
        $str2 => 'The :attribute must be greater than :value.',
        'file'    => 'The :attribute must be greater than :value kilobytes.',
        $str1 => 'The :attribute must be greater than :value characters.',
        $str => 'The :attribute must have more than :value items.',
    ],
    'gte'                  => [
        $str2 => 'The :attribute must be greater than or equal :value.',
        'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
        $str1 => 'The :attribute must be greater than or equal :value characters.',
        $str => 'The :attribute must have :value items or more.',
    ],
    'image'                => ':attribute एक छवि होनी चाहिए।',
    'in'                   => $str3,
    'in_array'             => ':attribute फील्ड, :other में मौजूद नहीं है।',
    'integer'              => ':attribute एक पूर्णांक होना चाहिए।',
    'ip'                   => ':attribute एक मान्य IP पता होना चाहिए।',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => ':attribute एक मान्य JSON स्ट्रिंग होना चाहिए।',
    'lt'                   => [
        $str2 => 'The :attribute must be less than :value.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        $str1 => 'The :attribute must be less than :value characters.',
        $str => 'The :attribute must have less than :value items.',
    ],
    'lte'                  => [
        $str2 => 'The :attribute must be less than or equal :value.',
        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
        $str1 => 'The :attribute must be less than or equal :value characters.',
        $str => 'The :attribute must not have more than :value items.',
    ],
    'max'                  => [
        $str2 => ':attribute, :max से बड़ा नहीं हो सकता है।',
        'file'    => ':attribute :max किलोबाइट से बड़ा नहीं हो सकता है।',
        $str1 => ':attribute, :max वर्णों से बड़ा नहीं हो सकता है।',
        $str => ':attribute, :max आइटमों से अधिक नहीं हो सकता है।',
    ],
    'mimes'                => ':attribute एक प्रकार की फ़ाइल: :values होना चाहिए।',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        $str2 => ':attribute कम से कम :min होना चाहिए।',
        'file'    => ':attribute कम से कम :min किलोबाइट होना चाहिए।',
        $str1 => ':attribute कम से कम :min वर्ण होना चाहिए।',
        $str => ':attribute कम से कम :min आइटम होना चाहिए।',
    ],
    'not_in'               => $str3,
    'not_regex'            => 'The :attribute format is invalid.',
    $str2 => ':attribute एक संख्या होनी चाहिए।',
    'present'              => ':attribute फील्ड मौजूद होना चाहिए।',
    'regex'                => ':attribute फॉर्मेट अमान्य है।',
    'required'             => ':attribute फील्ड आवश्यक होता है।',
    'required_if'          => ':attribute फ़ील्ड आवश्यक होता है जब :other :value होता है।',
    'required_unless'      => ':attribute फील्ड आवश्यक होता है जब :other, :values में नहीं होता है।',
    'required_with'        => ':attribute फ़ील्ड आवश्यक होता है जब :values मौजूद होता है।',
    'required_with_all'    => ':attribute फ़ील्ड आवश्यक होता है जब :values मौजूद होता है।',
    'required_without'     => ':attribute फील्ड आवश्यक होता है जब :values मौजूद नहीं होता है।',
    'required_without_all' => ':attribute फील्ड आवश्यक होता है जब एक भी :values मौजूद नहीं होता है।',
    'same'                 => ':attribute और :other मेल खाना चाहिए।',
    'size'                 => [
        $str2 => ':attribute, :size होना चाहिए।',
        'file'    => ':attribute, :size किलोबाइट होना चाहिए।',
        $str1 => ':attribute, :size वर्ण होना चाहिए।',
        $str => ':attribute में :size आइटम होने चाहिए।',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    $str1 => ':attribute एक स्ट्रिंग होनी चाहिए।',
    'timezone'             => ':attribute एक मान्य क्षेत्र होना चाहिए।',
    'unique'               => ':attribute को पहले ही ले लिया गया है।',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => ':attribute फॉर्मेट अमान्य है।',
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
            'rule-name' => 'अनुकूल-संदेश',
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
        'test_name'               => 'टेस्ट का नाम',
        'test_description'        => 'टेस्ट का विवरण',
        'test_locale'             => 'भाषा',
        'image'                   => 'छवि',
        'result_text_under_image' => 'छवि के नीचे परिणाम पाठ',
        'short_text'              => 'लघु पाठ',
    ],
];
