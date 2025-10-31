<?php
return [
    'service_manager' => [
        'lazy_services' => [
            // directory where proxy classes will be written - default to system_get_tmp_dir()
            'proxies_target_dir' => 'data/ocraProxy',
        
            // namespace of the generated proxies, default to "ProxyManagerGeneratedProxy"
            'proxies_namespace' => null,
        
            // whether the generated proxy classes should be written to disk or generated on-the-fly
            'write_proxy_files' => true,
        ],
    ],
];
