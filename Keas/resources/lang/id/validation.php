<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
$str3 = 'Isian :attribute yang dipilih tidak valid.';
$str4 = 'Format isian :attribute tidak valid.';
return [
    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi standar pesan kesalahan yang digunakan oleh
    | kelas validasi. Beberapa aturan mempunyai multi versi seperti aturan 'size'.
    | Jangan ragu untuk mengoptimalkan setiap pesan yang ada di sini.
    |
    */

    'accepted'             => 'Isian :attribute harus diterima.',
    'active_url'           => 'Isian :attribute bukan URL yang valid.',
    'after'                => 'Isian :attribute harus tanggal setelah :date.',
    'after_or_equal'       => 'Isian :attribute harus berupa tanggal setelah atau sama dengan tanggal :date.',
    'alpha'                => 'Isian :attribute hanya boleh berisi huruf.',
    'alpha_dash'           => 'Isian :attribute hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num'            => 'Isian :attribute hanya boleh berisi huruf dan angka.',
    $str => 'Isian :attribute harus berupa sebuah array.',
    'before'               => 'Isian :attribute harus tanggal sebelum :date.',
    'before_or_equal'      => 'Isian :attribute harus berupa tanggal sebelum atau sama dengan tanggal :date.',
    'between'              => [
        $str1 => 'Isian :attribute harus antara :min dan :max.',
        'file'    => 'Bidang :attribute harus antara :min dan :max kilobyte.',
        $str2 => 'Isian :attribute harus antara :min dan :max karakter.',
        $str => 'Isian :attribute harus antara :min dan :max item.',
    ],
    'boolean'              => 'Isian :attribute harus berupa true atau false',
    'confirmed'            => 'Konfirmasi :attribute tidak cocok.',
    'date'                 => 'Isian :attribute bukan tanggal yang valid.',
    'date_equals'          => ':attribute harus berupa tanggal yang sama dengan :date.',
    'date_format'          => 'Isian :attribute tidak cocok dengan format :format.',
    'different'            => 'Isian :attribute dan :other harus berbeda.',
    'digits'               => 'Isian :attribute harus berupa angka :digits.',
    'digits_between'       => 'Isian :attribute harus antara angka :min dan :max.',
    'dimensions'           => 'Bidang :attribute tidak memiliki dimensi gambar yang valid.',
    'distinct'             => 'Bidang isian :attribute memiliki nilai yang duplikat.',
    'email'                => 'Isian :attribute harus berupa alamat surel yang valid.',
    'exists'               => $str3,
    'file'                 => 'Bidang :attribute harus berupa sebuah berkas.',
    'filled'               => 'Isian :attribute harus memiliki nilai.',
    'gt'                   => [
        $str1 => 'Isian :attribute harus lebih besar dari :value.',
        'file'    => 'Bidang :attribute harus lebih besar dari :value kilobyte.',
        $str2 => 'Isian :attribute harus lebih besar dari :value karakter.',
        $str => 'Isian :attribute harus lebih dari :value item.',
    ],
    'gte'                  => [
        $str1 => 'Isian :attribute harus lebih besar dari atau sama dengan :value.',
        'file'    => 'Bidang :attribute harus lebih besar dari atau sama dengan :value kilobyte.',
        $str2 => 'Isian :attribute harus lebih besar dari atau sama dengan :value karakter.',
        $str => 'Isian :attribute harus mempunyai :value item atau lebih.',
    ],
    'image'                => 'Isian :attribute harus berupa gambar.',
    'in'                   => $str3,
    'in_array'             => 'Bidang isian :attribute tidak terdapat dalam :other.',
    'integer'              => 'Isian :attribute harus merupakan bilangan bulat.',
    'ip'                   => 'Isian :attribute harus berupa alamat IP yang valid.',
    'ipv4'                 => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
    'json'                 => 'Isian :attribute harus berupa JSON string yang valid.',
    'lt'                   => [
        $str1 => 'Isian :attribute harus kurang dari :value.',
        'file'    => 'Bidang :attribute harus kurang dari :value kilobyte.',
        $str2 => 'Isian :attribute harus kurang dari :value karakter.',
        $str => 'Isian :attribute harus kurang dari :value item.',
    ],
    'lte'                  => [
        $str1 => 'Isian :attribute harus kurang dari atau sama dengan :value.',
        'file'    => 'Bidang :attribute harus kurang dari atau sama dengan :value kilobyte.',
        $str2 => 'Isian :attribute harus kurang dari atau sama dengan :value karakter.',
        $str => 'Isian :attribute harus tidak lebih dari :value item.',
    ],
    'max'                  => [
        $str1 => 'Isian :attribute seharusnya tidak lebih dari :max.',
        'file'    => 'Bidang :attribute seharusnya tidak lebih dari :max kilobyte.',
        $str2 => 'Isian :attribute seharusnya tidak lebih dari :max karakter.',
        $str => 'Isian :attribute seharusnya tidak lebih dari :max item.',
    ],
    'mimes'                => 'Isian :attribute harus dokumen berjenis : :values.',
    'mimetypes'            => 'Isian :attribute harus dokumen berjenis : :values.',
    'min'                  => [
        $str1 => 'Isian :attribute harus minimal :min.',
        'file'    => 'Bidang :attribute harus minimal :min kilobyte.',
        $str2 => 'Isian :attribute harus minimal :min karakter.',
        $str => 'Isian :attribute harus minimal :min item.',
    ],
    'not_in'               => $str3,
    'not_regex'            => $str4,
    $str1 => 'Isian :attribute harus berupa angka.',
    'present'              => 'Bidang isian :attribute wajib ada.',
    'regex'                => $str4,
    'required'             => 'Bidang isian :attribute wajib diisi.',
    'required_if'          => 'Bidang isian :attribute wajib diisi bila :other adalah :value.',
    'required_unless'      => 'Bidang isian :attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'        => 'Bidang isian :attribute wajib diisi bila terdapat :values.',
    'required_with_all'    => 'Bidang isian :attribute wajib diisi bila terdapat :values.',
    'required_without'     => 'Bidang isian :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Bidang isian :attribute wajib diisi bila tidak terdapat ada :values.',
    'same'                 => 'Isian :attribute dan :other harus sama.',
    'size'                 => [
        $str1 => 'Isian :attribute harus berukuran :size.',
        'file'    => 'Bidang :attribute harus berukuran :size kilobyte.',
        $str2 => 'Isian :attribute harus berukuran :size karakter.',
        $str => 'Isian :attribute harus mengandung :size item.',
    ],
    'starts_with'          => ':attribute harus dimulai dengan salah satu dari berikut ini: :values',
    $str2 => 'Isian :attribute harus berupa string.',
    'timezone'             => 'Isian :attribute harus berupa zona waktu yang valid.',
    'unique'               => 'Isian :attribute sudah ada sebelumnya.',
    'uploaded'             => 'Isian :attribute gagal diunggah.',
    'url'                  => $str4,
    'uuid'                 => ':attribute harus UUID yang valid.',

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi Kustom
    |---------------------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan menggunakan
    | konvensi "attribute.rule" dalam penamaan baris. Hal ini membuat cepat dalam
    | menentukan spesifik baris bahasa kustom untuk aturan atribut yang diberikan.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |---------------------------------------------------------------------------------------
    | Kustom Validasi Atribut
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar atribut 'place-holders'
    | dengan sesuatu yang lebih bersahabat dengan pembaca seperti Alamat Surel daripada
    | "surel" saja. Ini benar-benar membantu kita membuat pesan sedikit bersih.
    |
    */

    'attributes' => [
    ],
];
