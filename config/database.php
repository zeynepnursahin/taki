<?php

use Illuminate\Support\Str;

return [

    /*
    |---------------------------------------------------------------------------
    | Default Database Connection Name
    |---------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => 'mysql', // Burada 'mysql' olarak belirledik

    /*
    |---------------------------------------------------------------------------
    | Database Connections
    |---------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'mysql' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',  // Veritabanı sunucusu (localhost veya IP adresi)
            'port' => '3306',       // MySQL varsayılan portu
            'database' => 'e_ticaret',  // Veritabanı adı
            'username' => 'root',      // MySQL kullanıcı adı
            'password' => 'zey345,,A',      // MySQL şifresi
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => null,
            ]) : [],
        ],

        // Diğer veritabanı bağlantıları burada (SQLite, PostgreSQL vb.) yer alabilir, ancak siz MySQL kullanıyorsunuz.
        // PostgreSQL veya SQLite bağlantıları gerektiğinde ekleyebilirsiniz.
        
    ],

    /*
    |---------------------------------------------------------------------------
    | Migration Repository Table
    |---------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |---------------------------------------------------------------------------
    | Redis Databases
    |---------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'phpredis',

        'default' => [
            'url' => null,
            'host' => '127.0.0.1',
            'password' => null,
            'port' => '6379',
            'database' => '0',
        ],

        'cache' => [
            'url' => null,
            'host' => '127.0.0.1',
            'password' => null,
            'port' => '6379',
            'database' => '1',
        ],

    ],

];
