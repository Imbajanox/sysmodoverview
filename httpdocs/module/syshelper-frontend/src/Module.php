<?php
namespace WirklichDigital\SyshelperFrontend;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const CONFIG_KEY = 'syshelper-frontend';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
