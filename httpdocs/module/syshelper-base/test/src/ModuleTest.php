<?php
namespace WirklichDigital\SyshelperBaseTest;

use PHPUnit\Framework\TestCase;
use WirklichDigital\SyshelperBase\Module;

class ModuleTest extends TestCase
{

    public function setUp()
    {
    }

    public function tearDown()
    {
    }

    public function testModule()
    {
        $this->assertTrue(class_exists(Module::class));
    }
}
