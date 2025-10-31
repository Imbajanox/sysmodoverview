<?php

use WirklichDigital\SwiftmailerMessenger\Module as SwiftmailerMessengerModule;

return [
    'wirklich-digital' => [
        SwiftmailerMessengerModule::CONFIG_KEY => [
            'options' => [
                'defaultFrom' => ['syshelper@jcdn.de' => gettext_noop('Invokable Syshelper')],
                'defaultSender' => null,
                'defaultReturnPath' => null,
                'defaultTo' => null,
                'defaultCc' => null,
                'defaultBcc' => null,
            ],
        ],
    ],
];
