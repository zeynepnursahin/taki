<?php

return [

    /*
    |--------------------------------------------------------------------------|
    | Authentication Defaults                                                   |
    |--------------------------------------------------------------------------|
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',  // Normal kullanıcılar için varsayılan guard
        'passwords' => 'users',  // Şifre sıfırlama işlemleri
    ],

    /*
    |--------------------------------------------------------------------------|
    | Authentication Guards                                                     |
    |--------------------------------------------------------------------------|
    |
    | Here you can define every authentication guard for your application.
    | A guard is responsible for determining how users are authenticated.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',  // Normal kullanıcılar için provider
        ],
        'yonetim' => [
            'driver' => 'session',
            'provider' => 'yonetim_users',  // Yönetici kullanıcıları için provider
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',  // API token için kullanıcı provider
            'hash' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------|
    | User Providers                                                           |
    |--------------------------------------------------------------------------|
    |
    | Every authentication driver has a user provider. This defines how the
    | users are retrieved from your database or other storage mechanisms.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Kullanici::class,  // Normal kullanıcı modeli
        ],
        'yonetim_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Kullanici::class,  // Yönetici kullanıcıları için aynı model kullanılabilir
        ],
    ],

    /*
    |--------------------------------------------------------------------------|
    | Password Reset Configurations                                             |
    |--------------------------------------------------------------------------|
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model and you want to have separate password
    | reset settings based on user types.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',  // Normal kullanıcılar için şifre sıfırlama
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        // Yönetici kullanıcıları için şifre sıfırlama ayarlarını ekleyebilirsiniz
    ],

    /*
    |--------------------------------------------------------------------------|
    | Password Confirmation Timeout                                             |
    |--------------------------------------------------------------------------|
    |
    | Defines the amount of time before a password confirmation times out.
    | By default, this lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
