<?php

namespace WirklichDigital\SystemModuleOverviewTest\Entity;

use PHPUnit\Framework\TestCase;
use WirklichDigital\SystemModuleOverview\Entity\LaminasSystemLog;
use DateTime;

class LaminasSystemLogTest extends TestCase
{
    private LaminasSystemLog $entity;
    
    public function setUp(): void
    {
        $this->entity = new LaminasSystemLog();
    }
    
    public function tearDown(): void
    {
        unset($this->entity);
    }
    
    public function testLevelGetterAndSetter()
    {
        $level = 'info';
        $this->entity->setLevel($level);
        $this->assertEquals($level, $this->entity->getLevel());
    }
    
    public function testMessageGetterAndSetter()
    {
        $message = 'Test log message';
        $this->entity->setMessage($message);
        $this->assertEquals($message, $this->entity->getMessage());
    }
    
    public function testContextGetterAndSetter()
    {
        $context = 'IndexController::receiveSystemInfosAction';
        $this->entity->setContext($context);
        $this->assertEquals($context, $this->entity->getContext());
    }
    
    public function testAdditionalDataGetterAndSetter()
    {
        $additionalData = ['key' => 'value', 'count' => 42];
        $this->entity->setAdditionalData($additionalData);
        $this->assertEquals($additionalData, $this->entity->getAdditionalData());
    }
    
    public function testCreatedAtGetterAndSetter()
    {
        $date = new DateTime('2025-10-31 12:00:00');
        $this->entity->setCreatedAt($date);
        $this->assertEquals($date, $this->entity->getCreatedAt());
    }
    
    public function testNullableFields()
    {
        $this->assertNull($this->entity->getId());
        $this->assertNull($this->entity->getLevel());
        $this->assertNull($this->entity->getMessage());
        $this->assertNull($this->entity->getContext());
        $this->assertNull($this->entity->getAdditionalData());
        $this->assertNull($this->entity->getCreatedAt());
    }
}
