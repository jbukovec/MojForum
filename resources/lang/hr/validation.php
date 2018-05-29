<?php

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

    'accepted'             => 'Polje :attribute mora biti prihvaćeno.',
    'active_url'           => 'Polje :attribute nije valjani URL.',
    'after'                => 'Polje :attribute mora biti datum poslje :date.',
    'after_or_equal'       => 'Polje :attribute must mora biti datum poslje ili jednak :date.',
    'alpha'                => 'Polje :attribute može sadržavati samo slova.',
    'alpha_dash'           => 'Polje :attribute može sadržavati samo slova, brojke, i crtice.',
    'alpha_num'            => 'Polje :attribute može sadržavati samo slova i brojke.',
    'array'                => 'Polje :attribute mora biti array.',
    'before'               => 'Polje :attribute mora biti datum prije :date.',
    'before_or_equal'      => 'Polje :attribute mora biti datum prije ili jedank :date.',
    'between'              => [
        'numeric' => 'Polje :attribute mora biti između :min i :max.',
        'file'    => 'Polje :attribute mora biti između :min i :max kilobajta.',
        'string'  => 'Polje :attribute mora biti između :min i :max znakova.',
        'array'   => 'Polje :attribute mora biti između :min i :max stavke.',
    ],
    'boolean'              => 'Polje :attribute mora biti točno ili netočno.',
    'confirmed'            => 'Polje :attribute - potvrda se ne podudara.',
    'date'                 => 'Polje :attribute nije valjan datum.',
    'date_format'          => 'Polje :attribute ne odgovara formatu :format.',
    'different'            => 'Polje :attribute i :other moraju biti različiti.',
    'digits'               => 'Polje :attribute mora biti :digits znamenke.',
    'digits_between'       => 'Polje :attribute mora biti između :min i :max znamenke.',
    'dimensions'           => 'Polje :attribute nema valjane dimenzije slike.',
    'distinct'             => 'Polje :attribute ima duplične vrijednosti.',
    'email'                => 'Polje :attribute mora biti valjana email adresa.',
    'exists'               => 'Polje :attribute je nevažeće.',
    'file'                 => 'Polje :attribute mora biti datoteka.',
    'filled'               => 'Polje :attribute mora imati vrijednost.',
    'image'                => 'Polje :attribute mora biti slika.',
    'in'                   => 'Polje :attribute nije važeće.',
    'in_array'             => 'Polje :attribute ne postoji u :other.',
    'integer'              => 'Polje :attribute mora biti cijeli broj.',
    'ip'                   => 'Polje :attribute mora biti važeća IP adresa.',
    'ipv4'                 => 'Polje :attribute mora biti važeća IPv4 adresa.',
    'ipv6'                 => 'Polje :attribute mora biti važeća IPv6 adresa.',
    'json'                 => 'Polje :attribute mora biti važeći JSON niz.',
    'max'                  => [
        'numeric' => 'Polje :attribute mora biti veće od :max.',
        'file'    => 'Polje :attribute mora biti veće od :max kilobajta.',
        'string'  => 'Polje :attribute mora biti veće od :max znakova.',
        'array'   => 'Polje :attribute ne smije imati više od :max stavki.',
    ],
    'mimes'                => 'Polje :attribute mora biti datoteka tipa: :values.',
    'mimetypes'            => 'Polje :attribute mora biti datoteka tipa :values.',
    'min'                  => [
        'numeric' => 'Polje :attribute mora biti najmanje :min.',
        'file'    => 'Polje :attribute mora biti najmanje :min kilobajta.',
        'string'  => 'Polje :attribute mora biti najmanje :min znakova.',
        'array'   => 'Polje :attribute mora imati najmanje :min stavke.',
    ],
    'not_in'               => 'Odabrano polje :attribute je nevažeće.',
    'not_regex'            => 'Format :attribute nije valjan.',
    'numeric'              => 'Polje :attribute mora biti broj.',
    'present'              => 'Polje :attribute mora biti prisutno.',
    'regex'                => 'Format :attribute nije valjan.',
    'required'             => 'Polje :attribute je obavezno.',
    'required_if'          => 'Polje :attribute je obavezno kada je :other :value.',
    'required_unless'      => 'Polje :attribute je obavezno osim ako je :other u :values.',
    'required_with'        => 'Polje :attribute je obavezno kada je :values prisutna.',
    'required_with_all'    => 'Polje :attribute je obavezno kada je :values prisutna.',
    'required_without'     => 'Polje :attribute je obavezno kada :values nije.',
    'required_without_all' => 'Polje :attribute je obavezno kada niti jedna od :values nisu prisutne.',
    'same'                 => 'Polje :attribute i :other se ne poklapaju.',
    'size'                 => [
        'numeric' => 'Polje :attribute mora biti :size.',
        'file'    => 'Polje :attribute mora biti :size kilobajta.',
        'string'  => 'Polje :attribute mora biti :size znakova.',
        'array'   => 'Polje :attribute mora sadržavati :size stavke.',
    ],
    'string'               => 'Polje :attribute mora biti string.',
    'timezone'             => 'Polje :attribute mora biti valjana zona.',
    'unique'               => 'Vrijednost polje mora biti jedinstvena, :attribute se već koristi.',
    'uploaded'             => 'Upload :attribute nije uspio .',
    'url'                  => 'Format :attribute nije valjan.',

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
        'name' => 'ime',
        'password' => 'lozinka',
        'current-password' => 'sadašnja lozinka',
        'new-password' => 'nova lozinka',
    ],

];
