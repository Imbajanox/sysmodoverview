<?php
namespace WirklichDigital\SystemModuleOverview;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const CONFIG_KEY = 'system-module-overview';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
