<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
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

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute deve conter uma URL válida.',
    'after'                => 'O campo :attribute deve conter uma data posterior a :date.',
    'after_or_equal'       => 'O campo :attribute deve conter uma data superior ou igual a :date.',
    'alpha'                => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute deve conter apenas letras, números e traços.',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números .',
    $str => 'O campo :attribute deve conter um array.',
    'before'               => 'O campo :attribute deve conter uma data anterior a :date.',
    'before_or_equal'      => 'O campo :attribute deve conter uma data inferior ou igual a :date.',
    'between'              => [
        $str1 => 'O campo :attribute deve conter um número entre :min e :max.',
        'file'    => 'O campo :attribute deve conter um arquivo de :min a :max kilobytes.',
        $str2 => 'O campo :attribute deve conter entre :min a :max caracteres.',
        $str => 'O campo :attribute deve conter de :min a :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve conter o valor verdadeiro ou falso.',
    'confirmed'            => 'A confirmação para o campo :attribute não coincide.',
    'date'                 => 'O campo :attribute não contém uma data válida.',
    'date_equals'          => 'O campo :attribute deve ser uma data igual a :date.',
    'date_format'          => 'A data informada para o campo :attribute não respeita o formato :format.',
    'different'            => 'Os campos :attribute e :other devem conter valores diferentes.',
    'digits'               => 'O campo :attribute deve conter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve conter entre :min a :max dígitos.',
    'dimensions'           => 'O valor informado para o campo :attribute não é uma dimensão de imagem válida.',
    'distinct'             => 'O campo :attribute contém um valor duplicado.',
    'email'                => 'O campo :attribute não contém um endereço de email válido.',
    'exists'               => 'O valor selecionado para o campo :attribute é inválido.',
    'file'                 => 'O campo :attribute deve conter um arquivo.',
    'filled'               => 'O campo :attribute é obrigatório.',
    'gt'                   => [
        $str1 => 'O campo :attribute deve ser maior que :value.',
        'file'    => 'O arquivo :attribute deve ser maior que :value kilobytes.',
        $str2 => 'O campo :attribute deve ser maior que :value caracteres.',
        $str => 'O campo :attribute deve ter mais que :value itens.',
    ],
    'gte'                  => [
        $str1 => 'O campo :attribute deve ser maior ou igual a :value.',
        'file'    => 'O arquivo :attribute deve ser maior ou igual a :value kilobytes.',
        $str2 => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
        $str => 'O campo :attribute deve ter :value itens ou mais.',
    ],
    'image'                => 'O campo :attribute deve conter uma imagem.',
    'in'                   => 'O campo :attribute não contém um valor válido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute deve conter um número inteiro.',
    'ip'                   => 'O campo :attribute deve conter um IP válido.',
    'ipv4'                 => 'O campo :attribute deve conter um IPv4 válido.',
    'ipv6'                 => 'O campo :attribute deve conter um IPv6 válido.',
    'json'                 => 'O campo :attribute deve conter uma string JSON válida.',
    'lt'                   => [
        $str1 => 'O campo :attribute deve ser menor que :value.',
        'file'    => 'O arquivo :attribute ser menor que :value kilobytes.',
        $str2 => 'O campo :attribute deve ser menor que :value caracteres.',
        $str => 'O campo :attribute deve ter menos que :value itens.',
    ],
    'lte'                  => [
        $str1 => 'O campo :attribute deve ser menor ou igual a :value.',
        'file'    => 'O arquivo :attribute ser menor ou igual a :value kilobytes.',
        $str2 => 'O campo :attribute deve ser menor ou igual a :value caracteres.',
        $str => 'O campo :attribute não deve ter mais que :value itens.',
    ],
    'max'                  => [
        $str1 => 'O campo :attribute não pode conter um valor superior a :max.',
        'file'    => 'O campo :attribute não pode conter um arquivo com mais de :max kilobytes.',
        $str2 => 'O campo :attribute não pode conter mais de :max caracteres.',
        $str => 'O campo :attribute deve conter no máximo :max itens.',
    ],
    'mimes'                => 'O campo :attribute deve conter um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo :attribute deve conter um arquivo do tipo: :values.',
    'min'                  => [
        $str1 => 'O campo :attribute deve conter um número superior ou igual a :min.',
        'file'    => 'O campo :attribute deve conter um arquivo com no mínimo :min kilobytes.',
        $str2 => 'O campo :attribute deve conter no mínimo :min caracteres.',
        $str => 'O campo :attribute deve conter no mínimo :min itens.',
    ],
    'not_in'               => 'O campo :attribute contém um valor inválido.',
    'not_regex'            => 'O formato do valor :attribute é inválido.',
    $str1 => 'O campo :attribute deve conter um valor numérico.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato do valor informado no campo :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando o valor do campo :other é igual a :value.',
    'required_unless'      => 'O campo :attribute é obrigatório a menos que :other esteja presente em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando um dos :values está presente.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values está presente.',
    'same'                 => 'Os campos :attribute e :other devem conter valores iguais.',
    'size'                 => [
        $str1 => 'O campo :attribute deve conter o número :size.',
        'file'    => 'O campo :attribute deve conter um arquivo com o tamanho de :size kilobytes.',
        $str2 => 'O campo :attribute deve conter :size caracteres.',
        $str => 'O campo :attribute deve conter :size itens.',
    ],
    'starts_with'          => 'O campo :attribute deve começar com um dos seguintes valores: :values',
    $str2 => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve conter um fuso horário válido.',
    'unique'               => 'O valor informado para o campo :attribute já está em uso.',
    'uploaded'             => 'Falha no Upload do arquivo :attribute.',
    'url'                  => 'O formato da URL informada para o campo :attribute é inválido.',
    'uuid'                 => 'O campo :attribute deve ser um UUID válido.',

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
        'address'               => 'endereço',
        'age'                   => 'idade',
        'body'                  => 'conteúdo',
        'city'                  => 'cidade',
        'country'               => 'país',
        'date'                  => 'data',
        'day'                   => 'dia',
        'description'           => 'descrição',
        'excerpt'               => 'resumo',
        'first_name'            => 'primeiro nome',
        'gender'                => 'gênero',
        'hour'                  => 'hora',
        'last_name'             => 'sobrenome',
        'message'               => 'mensagem',
        'minute'                => 'minuto',
        'mobile'                => 'celular',
        'month'                 => 'mês',
        'name'                  => 'nome',
        'password_confirmation' => 'confirmação da senha',
        'password'              => 'senha',
        'phone'                 => 'telefone',
        'second'                => 'segundo',
        'sex'                   => 'sexo',
        'state'                 => 'estado',
        'subject'               => 'assunto',
        'text'                  => 'texto',
        'time'                  => 'hora',
        'title'                 => 'título',
        'username'              => 'usuário',
        'year'                  => 'ano',
        'email'                 => 'e-mail',
        'remember'              => 'lembrar-se de mim',
    ],
];
