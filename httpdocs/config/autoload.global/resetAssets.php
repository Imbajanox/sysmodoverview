<?php

return [
    'wirklich-digital' => [
        'admin' => [
            // Allow or disallow the deletion of generated assets in the public/assets folder
            // via the get parameter reset_assets=1

            // This results the assets to be regenerated on page load
            // Don't allow deletion by default, so we avoid potential system failures in live environments
            'enable-reset-assets' => false,
        ],
    ],
];
