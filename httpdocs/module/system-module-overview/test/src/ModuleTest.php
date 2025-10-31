<?php
namespace WirklichDigital\SystemModuleOverviewTest;

use PHPUnit\Framework\TestCase;
use WirklichDigital\SystemModuleOverview\Module;

class ModuleTest extends TestCase
{

    public function setUp(): void
    {
    }

    public function tearDown(): void
    {
    }

    public function testModule()
    {
        $this->assertTrue(class_exists(Module::class));
    }
}
