<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = ':attribute tidak sah.';
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

    'accepted'             => ':attribute mesti diterima pakai.',
    'active_url'           => ':attribute bukan URL yang sah.',
    'after'                => ':attribute mesti tarikh selepas :date.',
    'after_or_equal'       => ':attribute mesti tarikh selepas atau sama dengan :date.',
    'alpha'                => ':attribute hanya boleh mengandungi huruf.',
    'alpha_dash'           => ':attribute boleh mengandungi huruf, nombor, dan sengkang.',
    'alpha_num'            => ':attribute boleh mengandungi huruf dan nombor.',
    $str => ':attribute mesti jujukan.',
    'before'               => ':attribute mesti tarikh sebelum :date.',
    'before_or_equal'      => ':attribute mesti tarikh sebelum atau sama dengan :date.',
    'between'              => [
        $str1 => ':attribute mesti mengandungi antara :min dan :max.',
        'file'    => ':attribute mesti mengandungi antara :min dan :max kilobait.',
        $str2 => ':attribute mesti mengandungi antara :min dan :max aksara.',
        $str => ':attribute mesti mengandungi antara :min dan :max perkara.',
    ],
    'boolean'              => ':attribute mesti benar atau salah.',
    'confirmed'            => ':attribute pengesahan yang tidak sepadan.',
    'date'                 => ':attribute bukan tarikh yang sah.',
    'date_equals'          => ':attribute mesti tarikh sama dengan :date.',
    'date_format'          => ':attribute tidak mengikut format :format.',
    'different'            => ':attribute dan :other mesti berlainan.',
    'dimensions'           => ':attribute tidak sah',
    'digits'               => ':attribute mesti :digits.',
    'digits_between'       => ':attribute mesti mengandungi antara :min dan :max digits.',
    'distinct'             => ':attribute adalah nilai yang berulang',
    'email'                => $str3,
    'exists'               => $str3,
    'file'                 => ':attribute mesti fail yang sah.',
    'filled'               => ':attribute diperlukan.',
    'gt'                   => [
        $str1 => ':attribute mesti melebihi :value.',
        'file'    => ':attribute mesti melebihi :value kilobait.',
        $str2 => ':attribute mesti melebihi :value aksara.',
        $str => ':attribute mesti mengandungi lebih daripada :value perkara.',
    ],
    'gte'                  => [
        $str1 => ':attribute mesti melebihi atau bersamaan :value.',
        'file'    => ':attribute mesti melebihi atau bersamaan :value kilobait.',
        $str2 => ':attribute mesti melebihi atau bersamaan :value aksara.',
        $str => ':attribute mesti mengandungi :value perkara atau lebih.',
    ],
    'image'                => ':attribute mesti imej.',
    'in'                   => $str3,
    'in_array'             => ':attribute tidak wujud dalam :other.',
    'integer'              => ':attribute mesti integer.',
    'ip'                   => ':attribute mesti alamat IP yang sah.',
    'ipv4'                 => ':attribute mesti alamat IPv4 yang sah.',
    'ipv6'                 => ':attribute mesti alamat IPv6 yang sah',
    'json'                 => ':attribute mesti JSON yang sah.',
    'lt'                   => [
        $str1 => ':attribute mesti kurang daripada :value.',
        'file'    => ':attribute mesti kurang daripada :value kilobait.',
        $str2 => ':attribute mesti kurang daripada :value aksara.',
        $str => ':attribute mesti mengandungi kurang daripada :value perkara.',
    ],
    'lte'                  => [
        $str1 => ':attribute mesti kurang daripada atau bersamaan dengan :value.',
        'file'    => ':attribute mesti kurang daripada atau bersamaan dengan :value kilobait.',
        $str2 => ':attribute mesti kurang daripada atau bersamaan dengan :value aksara.',
        $str => ':attribute mesti mengandungi kurang daripada atau bersamaan dengan :value perkara.',
    ],
    'max'                  => [
        $str1 => 'Jumlah :attribute mesti tidak melebihi :max.',
        'file'    => 'Jumlah :attribute mesti tidak melebihi :max kilobait.',
        $str2 => 'Jumlah :attribute mesti tidak melebihi :max aksara.',
        $str => 'Jumlah :attribute mesti tidak melebihi :max perkara.',
    ],
    'mimes'                => ':attribute mesti fail type: :values.',
    'mimetypes'            => ':attribute mesti fail type: :values.',
    'min'                  => [
        $str1 => 'Jumlah :attribute mesti sekurang-kurangnya :min.',
        'file'    => 'Jumlah :attribute mesti sekurang-kurangnya :min kilobait.',
        $str2 => 'Jumlah :attribute mesti sekurang-kurangnya :min aksara.',
        $str => 'Jumlah :attribute mesti sekurang-kurangnya :min perkara.',
    ],
    'not_in'               => $str3,
    'not_regex'            => 'Format :attribute adalah tidak sah.',
    $str1 => ':attribute mesti nombor.',
    'present'              => ':attribute mesti wujud.',
    'regex'                => 'Format :attribute tidak sah.',
    'required'             => 'Ruangan :attribute diperlukan.',
    'required_if'          => 'Ruangan :attribute diperlukan bila :other sama dengan :value.',
    'required_unless'      => 'Ruangan :attribute diperlukan sekiranya :other ada dalam :values.',
    'required_with'        => 'Ruangan :attribute diperlukan bila :values wujud.',
    'required_with_all'    => 'Ruangan :attribute diperlukan bila :values wujud.',
    'required_without'     => 'Ruangan :attribute diperlukan bila :values tidak wujud.',
    'required_without_all' => 'Ruangan :attribute diperlukan bila kesemua :values wujud.',
    'same'                 => 'Ruangan :attribute dan :other mesti sepadan.',
    'size'                 => [
        $str1 => 'Saiz :attribute mesti :size.',
        'file'    => 'Saiz :attribute mesti :size kilobait.',
        $str2 => 'Saiz :attribute mesti :size aksara.',
        $str => 'Saiz :attribute mesti mengandungi :size perkara.',
    ],
    'starts_with'          => ':attribute mesti bermula dengan salah satu dari: :values',
    $str2 => ':attribute mesti aksara.',
    'timezone'             => ':attribute mesti zon masa yang sah.',
    'unique'               => ':attribute telah wujud.',
    'uploaded'             => ':attribute gagal dimuat naik.',
    'url'                  => ':attribute format tidak sah.',
    'uuid'                 => ':attribute mesti UUID yang sah.',

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
