<?php
namespace WirklichDigital\SyshelperBase;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const CONFIG_KEY = 'syshelper-base';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

}
