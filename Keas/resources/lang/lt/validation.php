<?php

$str = 'array';
$str1 = 'numeric';
$str2 = 'string';
return [
    /*
    |--------------------------------------------------------------------------
    | Patvirtinimo kalbos eilutės
    |--------------------------------------------------------------------------
    |
    | Sekančios kalbos eilutėse yra numatyti klaidos pranešimai naudojami
    | patvirtinimo klasėje. Kai kurios iš šių eilučių turi keletą versijų
    | tokių kaip dydžio taisyklės. Galite laisvai pataisyti bet kuriuos pranešimus.
    |
    */
    'accepted'             => 'Laukas :attribute turi būti priimtas.',
    'active_url'           => 'Laukas :attribute nėra galiojantis internetinis adresas.',
    'after'                => 'Lauko :attribute reikšmė turi būti po :date datos.',
    'after_or_equal'       => 'Lauko :attribute reikšmė privalo būti data lygi arba vėlesnė negu :date.',
    'alpha'                => 'Laukas :attribute gali turėti tik raides.',
    'alpha_dash'           => 'Laukas :attribute gali turėti tik raides, skaičius ir brūkšnelius.',
    'alpha_num'            => 'Laukas :attribute gali turėti tik raides ir skaičius.',
    $str => 'Laukas :attribute turi būti masyvas.',
    'before'               => 'Laukas :attribute turi būti data prieš :date.',
    'before_or_equal'      => 'Lauko :attribute reikšmė privalo būti data lygi arba ankstesnė negu :date.',
    'between'              => [
        $str1 => 'Lauko :attribute reikšmė turi būti tarp :min ir :max.',
        'file'    => 'Failo dydis lauke :attribute turi būti tarp :min ir :max kilobaitų.',
        $str2 => 'Simbolių skaičius lauke :attribute turi būti tarp :min ir :max.',
        $str => 'Elementų skaičius lauke :attribute turi turėti nuo :min iki :max.',
    ],
    'boolean'              => "Lauko reikšmė :attribute turi būti 'taip' arba 'ne'.",
    'confirmed'            => 'Lauko :attribute patvirtinimas nesutampa.',
    'date'                 => 'Lauko :attribute reikšmė nėra galiojanti data.',
    'date_equals'          => 'Lauko :attribute reikšmė turi būti data lygi :date.',
    'date_format'          => 'Lauko :attribute reikšmė neatitinka formato :format.',
    'different'            => 'Laukų :attribute ir :other reikšmės turi skirtis.',
    'digits'               => 'Laukas :attribute turi būti sudarytas iš :digits skaitmenų.',
    'digits_between'       => 'Laukas :attribute tuti turėti nuo :min iki :max skaitmenų.',
    'dimensions'           => 'Lauke :attribute įkeltas paveiksliukas neatitinka išmatavimų reikalavimo.',
    'distinct'             => 'Laukas :attribute pasikartoja.',
    'email'                => 'Lauko :attribute reikšmė turi būti galiojantis el. pašto adresas.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'Laukas :attribute turi būti užpildytas.',
    'exists'               => 'Pasirinkta negaliojanti :attribute reikšmė.',
    'gt'                   => [
        $str1 => 'Lauko :attribute reikšmė turi būti didesnė negu :value.',
        'file'    => 'Lauko :attribute reikšmė turi būti didesnė negu :value kilobaitai.',
        $str2 => 'Lauko :attribute reikšmė turi būti didesnė negu :value simboliai.',
        $str => 'Laukas :attribute turi turėti daugiau nei :value elementus.',
    ],
    'gte'                  => [
        $str1 => 'Lauko :attribute reikšmė turi būti didesnė arba lygi :value.',
        'file'    => 'Lauko :attribute reikšmė turi būti didesnė arba lygi :value kilobaitams.',
        $str2 => 'Lauko :attribute reikšmė turi būti didesnė arba lygi :value simboliams.',
        $str => 'Laukas :attribute  turi turėti :value elementus arba daugiau.',
    ],
    'image'                => 'Lauko :attribute reikšmė turi būti paveikslėlis.',
    'in'                   => 'Pasirinkta negaliojanti :attribute reikšmė.',
    'in_array'             => 'Laukas :attribute neegzistuoja :other lauke.',
    'integer'              => 'Lauko :attribute reikšmė turi būti sveikasis skaičius.',
    'ip'                   => 'Lauko :attribute reikšmė turi būti galiojantis IP adresas.',
    'ipv4'                 => 'Lauko :attribute reikšmė turi būti galiojantis IPv4 adresas.',
    'ipv6'                 => 'Lauko :attribute reikšmė turi būti galiojantis IPv6 adresas.',
    'json'                 => 'Lauko :attribute reikšmė turi būti JSON tekstas.',
    'lt'                   => [
        $str1 => 'Lauko :attribute reikšmė turi būti mažesnė negu :value.',
        'file'    => 'Lauko :attribute reikšmė turi būti mažesnė negu :value kilobaitai.',
        $str2 => 'Lauko :attribute reikšmė turi būti mažesnė negu :value simboliai.',
        $str => 'Laukas :attribute turi turėti mažiau negu :value elementus.',
    ],
    'lte'                  => [
        $str1 => 'Lauko :attribute reikšmė turi būti mažesnė arba lygi :value.',
        'file'    => 'Lauko :attribute reikšmė turi būti mažesnė arba lygi :value kilobaitams.',
        $str2 => 'Lauko :attribute  reikšmė turi būti mažesnė arba lygi :value simboliams.',
        $str => 'Laukas :attribute turi turėti mažiau arba lygiai :value elementus.',
    ],
    'max'                  => [
        $str1 => 'Lauko :attribute reikšmė negali būti didesnė nei :max.',
        'file'    => 'Failo dydis lauke :attribute reikšmė negali būti didesnė nei :max kilobaitų.',
        $str2 => 'Simbolių kiekis lauke :attribute reikšmė negali būti didesnė nei :max simbolių.',
        $str => 'Elementų kiekis lauke :attribute negali turėti daugiau nei :max elementų.',
    ],
    'mimes'                => 'Lauko reikšmė :attribute turi būti failas vieno iš sekančių tipų: :values.',
    'mimetypes'            => 'Lauko reikšmė :attribute turi būti failas vieno iš sekančių tipų: :values.',
    'min'                  => [
        $str1 => 'Lauko :attribute reikšmė turi būti ne mažesnė nei :min.',
        'file'    => 'Failo dydis lauke :attribute turi būti ne mažesnis nei :min kilobaitų.',
        $str2 => 'Simbolių kiekis lauke :attribute turi būti ne mažiau nei :min.',
        $str => 'Elementų kiekis lauke :attribute turi būti ne mažiau nei :min.',
    ],
    'not_in'               => 'Pasirinkta negaliojanti reikšmė :attribute.',
    'not_regex'            => 'Lauko :attribute formatas yra neteisingas.',
    $str1 => 'Lauko :attribute reikšmė turi būti skaičius.',
    'present'              => 'Laukas :attribute turi egzistuoti.',
    'regex'                => 'Negaliojantis lauko :attribute formatas.',
    'required'             => 'Privaloma užpildyti lauką :attribute.',
    'required_if'          => 'Privaloma užpildyti lauką :attribute kai :other yra :value.',
    'required_unless'      => 'Laukas :attribute yra privalomas, nebent :other yra tarp :values reikšmių.',
    'required_with'        => 'Privaloma užpildyti lauką :attribute kai pateikta :values.',
    'required_with_all'    => 'Privaloma užpildyti lauką :attribute kai pateikta :values.',
    'required_without'     => 'Privaloma užpildyti lauką :attribute kai nepateikta :values.',
    'required_without_all' => 'Privaloma užpildyti lauką :attribute kai nepateikta nei viena iš reikšmių :values.',
    'same'                 => 'Laukai :attribute ir :other turi sutapti.',
    'size'                 => [
        $str1 => 'Lauko :attribute reikšmė turi būti :size.',
        'file'    => 'Failo dydis lauke :attribute turi būti :size kilobaitai.',
        $str2 => 'Simbolių skaičius lauke :attribute turi būti :size.',
        $str => 'Elementų kiekis lauke :attribute turi būti :size.',
    ],
    'starts_with'          => 'Laukas :attribute turi prasidėti vienu iš: :values',
    $str2 => 'Laukas :attribute turi būti tekstinis.',
    'timezone'             => 'Lauko :attribute reikšmė turi būti galiojanti laiko zona.',
    'unique'               => 'Tokia :attribute reikšmė jau pasirinkta.',
    'uploaded'             => 'Nepavyko įkelti :attribute lauko.',
    'url'                  => 'Negaliojantis lauko :attribute formatas.',
    'uuid'                 => 'Lauko :attribute reikšmė turi būti galiojantis UUID.',
    /*
    |--------------------------------------------------------------------------
    | Pasirinktiniai patvirtinimo kalbos eilutės
    |--------------------------------------------------------------------------
    |
    | Čia galite nurodyti pasirinktinius patvirtinimo pranešimus, naudodami
    | konvenciją "attribute.rule" eilučių pavadinimams. Tai leidžia greitai
    | nurodyti konkrečią pasirinktinę kalbos eilutę tam tikrai atributo taisyklei.
    |
    */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Pasirinktiniai patvirtinimo atributai
    |--------------------------------------------------------------------------
    |
    | Sekančios kalbos eilutės naudojamos pakeisti vietos žymes
    | kuo nors labiau priimtinu skaitytojui (pvz. "El.Pašto Adresas" vietoj
    | "email". TTai tiesiog padeda mums padaryti žinutes truputi aiškesnėmis.
    |
    */
    'attributes' => [
    ],
];
