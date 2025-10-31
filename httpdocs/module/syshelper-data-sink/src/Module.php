<?php
namespace WirklichDigital\SyshelperDataSink;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const CONFIG_KEY = 'syshelper-data-sink';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
