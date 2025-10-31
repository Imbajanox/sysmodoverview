<?php
namespace XelaxMailConfig;

use Zend\Mail\Transport\Smtp;

return [
    // Mailing config

    Module::CONFIG_KEY => [
        'type'    => Smtp::class,
        'options' => [
            // smtp server access setting
            'name'              => 'localhost',
            'host'              => '127.0.0.1',
        ],
    ],
];
