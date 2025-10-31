<?php
namespace WirklichDigital\SyshelperScannerTest;

use PHPUnit\Framework\TestCase;
use WirklichDigital\SyshelperScanner\Module;

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
