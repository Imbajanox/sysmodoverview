<?php

namespace WirklichDigital\SystemModuleOverviewTest\Entity;

use PHPUnit\Framework\TestCase;
use WirklichDigital\SystemModuleOverview\Entity\ProcessedFile;
use DateTime;

class ProcessedFileTest extends TestCase
{
    private ProcessedFile $entity;
    
    public function setUp(): void
    {
        $this->entity = new ProcessedFile();
    }
    
    public function tearDown(): void
    {
        unset($this->entity);
    }
    
    public function testFilenameGetterAndSetter()
    {
        $filename = 'test-system-192.168.1.1.json';
        $this->entity->setFilename($filename);
        $this->assertEquals($filename, $this->entity->getFilename());
    }
    
    public function testFilePathGetterAndSetter()
    {
        $filePath = 'data/sysmoddatas/systems/test-system-192.168.1.1.json';
        $this->entity->setFilePath($filePath);
        $this->assertEquals($filePath, $this->entity->getFilePath());
    }
    
    public function testFileHashGetterAndSetter()
    {
        $fileHash = 'abc123def456';
        $this->entity->setFileHash($fileHash);
        $this->assertEquals($fileHash, $this->entity->getFileHash());
    }
    
    public function testProcessedAtGetterAndSetter()
    {
        $date = new DateTime('2025-10-31 08:00:00');
        $this->entity->setProcessedAt($date);
        $this->assertEquals($date, $this->entity->getProcessedAt());
    }
    
    public function testStatusGetterAndSetter()
    {
        $status = 'success';
        $this->entity->setStatus($status);
        $this->assertEquals($status, $this->entity->getStatus());
    }
    
    public function testErrorMessageGetterAndSetter()
    {
        $errorMessage = 'Invalid JSON format';
        $this->entity->setErrorMessage($errorMessage);
        $this->assertEquals($errorMessage, $this->entity->getErrorMessage());
    }
    
    public function testNullableFields()
    {
        $this->assertNull($this->entity->getId());
        $this->assertNull($this->entity->getFilename());
        $this->assertNull($this->entity->getFilePath());
        $this->assertNull($this->entity->getFileHash());
        $this->assertNull($this->entity->getProcessedAt());
        $this->assertNull($this->entity->getStatus());
        $this->assertNull($this->entity->getErrorMessage());
    }
}
