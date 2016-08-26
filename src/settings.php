<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'db' => [
            'driver' => 'pgsql',
            'host' => 'ec2-54-221-253-117.compute-1.amazonaws.com',
            'username' => 'imtynijwmtxgae',
            'password' => 'fXpToMWU6O960nyKacF_1vvGKS',
            'database' => 'dceklmad3kgouk',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => '',
        ],
    ],
];
