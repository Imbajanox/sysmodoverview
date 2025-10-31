<?php

return [
    'wirklich-digital' => [
        'admin' => [
            // Allow or disallow the deletion of generated assets in the public/assets folder
            // via the get parameter reset_assets=1

            // This results the assets to be regenerated on page load
            // Allow deletion in dev mode
            'enable-reset-assets' => true,
        ],
    ],
];
