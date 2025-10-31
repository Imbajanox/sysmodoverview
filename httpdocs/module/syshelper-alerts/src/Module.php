<?php
namespace WirklichDigital\SyshelperAlerts;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const CONFIG_KEY = 'syshelper-alerts';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
