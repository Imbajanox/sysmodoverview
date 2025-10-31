<?php
namespace WirklichDigital\SyshelperScanner;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const CONFIG_KEY = 'syshelper-scanner';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
