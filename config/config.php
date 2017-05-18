<?php
return new \Phalcon\Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'dbname' => 'phasty',
        'charset' => 'utf8',
    ],
    'app' => [
        'cacheDir' => BASE_DIR . '/var/cache/',
        'publicUrl' => 'phasty.tk/',
        'cryptSalt' => 'your_unique_salt', //generate unique for your site!!!!!!!!
        'jwtSecret' => 'Your_unique_secret_key', //generate unique for your site!!!!!!!!
        'jwtAlgorithm' => 'HS256',
        'locale' => 'en_US',
        'currency' => 'EUR',
        'productImagesPath' => DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR,
        'productImagesNumber' => 5,
        'productImagesTypes' => ['image/jpeg', 'image/png', 'image/gif']
    ],
    'mail' => [
        'viewsDir' => BASE_DIR . '/app/Front/views/email/',
        'driver' => 'smtp',
        "host" => "smtp.qq.com",
        "port" => 25,
        "username" => "565720073@qq.com",
        "password" => "faraonexx",
        //"sendmail" => "/usr/sbin/sendmail -bs",
        'encryption' => 'tls',
        'from' => [
            'email' => 'an_qiao@qq.com',
            'name' => 'an_qiao@qq.com'
        ]
    ],
    'OAuth' => ['baseUrl' => 'http://' . $_SERVER['SERVER_NAME'] . '/social', "providers" => [
        "OpenId" => ["enabled" => false,
            "Yahoo" => ["enabled" => false],
            "Vkontakte" => ["enabled" => true, "keys" => ["id" => "", "secret" => ""]],
            "Mailru" => ["enabled" => true, "keys" => ["id" => "", "secret" => ""]],
            "Google" => [
                "enabled" => true,
                "keys" => ["id" => "", "secret" => ""],
                "scope" => "email"],
            "Facebook" => [
                "enabled" => true,
                "keys" => ["id" => "", "secret" => ""],
                "scope" => "email,publish_stream",
                "display" => ""],
            "Twitter" => ["enabled" => true, "keys" => ["key" => "", "secret" => ""]],
            "LinkedIn" => ["enabled" => true, "keys" => ["key" => "", "secret" => ""]]
        ]
    ]],

    'models' => ['metadata' => ['adapter' => 'Redis']],
    'session' => ['adapter' => 'Redis'],
    'application' => [
        'appDir'         => BASE_DIR . '/',
        'controllersDir' => BASE_DIR . '/controllers/',
        'modelsDir'      => BASE_DIR . '/models/',
        'migrationsDir'  => BASE_DIR . '/migrations/',
        'viewsDir'       => BASE_DIR . '/views/',
        'pluginsDir'     => BASE_DIR . '/plugins/',
        'libraryDir'     => BASE_DIR . '/library/',
        'cacheDir'       => BASE_DIR . '/cache/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ],
    'domain'=>'http://public.dev:88/',
]);
