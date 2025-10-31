# System Module Overview

A comprehensive Laminas Framework module for monitoring, tracking, and managing Laminas-based systems, their dependencies, and server configurations.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Architecture](#architecture)
- [Entities](#entities)
- [Services](#services)
- [Cronjobs](#cronjobs)
- [API Endpoints](#api-endpoints)
- [Testing](#testing)
- [Documentation](#documentation)
- [Contributing](#contributing)
- [License](#license)

## Overview

The System Module Overview module provides a centralized solution for tracking and managing multiple Laminas-based installations across your infrastructure. It automatically collects, processes, and analyzes system information including:

- Installed Composer and NPM packages
- PHP versions and configurations
- Database information and migration states
- Module dependencies and relationships
- System update availability
- Server health metrics

## Features

### 🎯 Core Capabilities

- **Multi-System Tracking**: Monitor multiple Laminas systems from a single dashboard
- **Automated Data Collection**: Scheduled cronjobs process system information files automatically
- **Duplicate Detection**: Content-based file hashing prevents reprocessing of duplicate data
- **Batch Processing**: Configurable batch sizes prevent system overload
- **Version Management**: Track module versions across all systems
- **Update Monitoring**: Identify outdated packages requiring updates

### 🛡️ Data Management

- **File Archiving**: Automatically archive processed files
- **Retention Policies**: Configurable data retention with automated cleanup
- **Error Tracking**: Comprehensive error logging for failed processing attempts
- **Database Logging**: Structured logging system for all module activities
- **Transaction Safety**: All operations are transaction-safe to prevent data corruption

### 📊 Reporting & Analysis

- **Module Statistics**: View which modules are installed across systems
- **Version Reports**: Compare module versions across different servers
- **Update Dashboards**: See which systems have available updates
- **Installation Matrix**: View which modules are installed on which servers
- **Database Health**: Monitor database sizes and configurations

### 🔒 Security & Quality

- **Input Validation**: Strict validation of all incoming data
- **Path Traversal Protection**: Filename sanitization prevents security vulnerabilities
- **Race Condition Handling**: Safe concurrent processing
- **PSR-12 Compliant**: Follows PHP coding standards
- **Test Coverage**: Unit tests for core functionality

## Installation

### Prerequisites

- PHP 8.1 or higher
- Laminas Framework (laminas-modulemanager ^2.12)
- Doctrine ORM
- MySQL/MariaDB database

### Via Composer

```bash
composer require wirklich-digital/system-module-overview
```

### Manual Installation

1. Clone or download the module to your `module/` directory
2. Enable the module in `config/modules.config.php`:

```php
return [
    // ... other modules
    'WirklichDigital\SystemModuleOverview',
];
```

3. Run database migrations:

```bash
php vendor/bin/doctrine-module migrations:migrate
```

## Configuration

### Basic Configuration

Add configuration to your `config/autoload/local.php` or module config:

```php
return [
    'wirklich-digital' => [
        'system-module-overview' => [
            'processing' => [
                // Maximum files to process per cronjob run
                'max_files_per_run' => 50,
                
                // Enable file archiving after successful processing
                'archive_processed_files' => true,
                
                // Number of days to keep processed file records
                'retention_days' => 30,
            ],
        ],
    ],
];
```

### Cronjob Configuration

The module includes two cronjobs:

#### SaveSystemdatasTask
Processes incoming system data files.

```php
'cron-scheduler' => [
    'jobs' => [
        CronTask\SaveSystemdatasTask::class => [
            'defaults' => [
                'cronString' => '* * * * *',      // Every minute
                'autoRestartAfter' => '120',      // Auto-restart after 2 minutes
                'enabled' => true,                 // Enabled by default
            ],
        ],
    ],
],
```

#### CleanupProcessedFilesTask
Cleans up old processed data.

```php
CronTask\CleanupProcessedFilesTask::class => [
    'defaults' => [
        'cronString' => '0 2 * * *',          // Daily at 2 AM
        'autoRestartAfter' => '120',
        'enabled' => true,                     // Enable for production
    ],
],
```

### Directory Structure

The module expects the following directory structure:

```
data/
  sysmoddatas/
    systems/      # Incoming JSON files are placed here
    processed/    # Successfully processed files are archived here
```

Ensure proper permissions:

```bash
mkdir -p data/sysmoddatas/systems data/sysmoddatas/processed
chmod 755 data/sysmoddatas/systems data/sysmoddatas/processed
```

## Usage

### Collecting System Information

Use the provided shell scripts on remote systems to collect and send data:

```bash
# Example using the remote collection script
bash remote_syshelper_send_info.sh.v1.0.5
```

The script collects system information and sends it as a JSON file to the configured endpoint.

### Processing Data

Data processing happens automatically via the `SaveSystemdatasTask` cronjob, but you can also trigger it manually:

```bash
# Via cron-scheduler (if available)
php public/index.php cron run SaveSystemdatasTask
```

### Viewing Data

Access the web interface to view collected data:

- **Systems List**: `/sysModOverview/system/list`
- **Servers List**: `/sysModOverview/system/server/list`
- **Modules List**: `/sysModOverview/module/list`
- **Module Details**: `/sysModOverview/module/view/{id}`

### API Endpoint

The module provides an API endpoint for receiving system information:

**POST** `/sysModOverview/receive-system-infos`

Send JSON data containing system information. The endpoint is accessible to guests for automated data submission.

## Architecture

### Design Patterns

The module follows modern PHP and Laminas best practices:

- **Service Layer**: Business logic separated into service classes
- **Repository Pattern**: Custom repository functions for complex queries
- **Factory Pattern**: Dependency injection via factories
- **Entity Pattern**: Doctrine ORM entities for data persistence
- **Transaction Pattern**: Database operations wrapped in transactions

### Component Structure

```
src/
├── Controller/         # Web controllers for UI
├── CronTask/          # Scheduled task implementations
├── Entity/            # Doctrine ORM entities
├── Form/              # Form definitions
├── Repository/        # Custom repository functions
├── Service/           # Business logic services
└── Table/             # Data table factories
```

## Entities

### Core Entities

#### ProcessedFile
Tracks processed system data files to prevent duplicates.

**Fields:**
- `id`: Auto-increment primary key
- `filename`: Original filename
- `filePath`: Full path to file
- `fileHash`: MD5 hash for duplicate detection (unique)
- `processedAt`: Processing timestamp (indexed)
- `status`: 'success' or 'error' (indexed)
- `errorMessage`: Error details if applicable

#### LaminasSystemLog
Database-backed logging for all module activities.

**Fields:**
- `id`: Auto-increment primary key
- `level`: Log level (info, warning, error, debug)
- `message`: Log message text
- `context`: Context identifier (e.g., class name)
- `additionalData`: JSON field for extra data
- `createdAt`: Log entry timestamp

#### LaminasSystem
Represents a system repository.

**Fields:**
- `id`: UUID primary key
- `repositoryName`: Human-readable name
- `repository`: Repository URL or identifier

#### LaminasSystemServer
Represents a server instance running a Laminas system.

**Fields:**
- `id`: Auto-increment primary key
- `ipAddress`: Server IP address (required)
- `url`: Server URL
- `phpVersion`: Installed PHP version
- `phpinfo`: PHP configuration details
- `config`: System configuration
- `isDevelopment`: Development environment flag
- `hasMinorUpdates`: Minor updates available flag
- `hasMajorUpdates`: Major updates available flag
- Plus many more fields for comprehensive tracking

#### ComposerModule
Tracks Composer packages across all systems.

**Fields:**
- `id`: Auto-increment primary key
- `vendor`: Package vendor
- `name`: Package name
- `systems`: Number of systems with this package
- `upToDate`: Number of up-to-date installations
- `outdated`: Number of outdated installations

### Supporting Entities

- **LaminasSystemServerModule**: Links servers to installed modules
- **NpmModules**: Tracks NPM package installations
- **LaminasSystemServerDatabaseInfo**: Database metadata
- **LaminasSystemServerMigrationInfo**: Migration state tracking
- **LaminasSystemServerComposerOutdated**: Outdated package tracking

## Services

### SysModOverviewService
Main service for processing system information from remote systems.

**Key Methods:**
- `setInfos(array $data)`: Process incoming system data
- Manages module version tracking
- Detects and resolves version conflicts
- Updates server metadata

### LaminasSystemLogService
Centralized logging service.

**Key Methods:**
- `log(string $message, string $level, ?string $context, ?array $data)`: Generic log
- `info(string $message, ?string $context, ?array $data)`: Info level
- `warning(string $message, ?string $context, ?array $data)`: Warning level
- `error(string $message, ?string $context, ?array $data)`: Error level
- `debug(string $message, ?string $context, ?array $data)`: Debug level

### ProcessedFileCleanupService
Manages cleanup of old processed data.

**Key Methods:**
- `cleanupOldRecords(?int $daysToKeep)`: Remove old database records
- `cleanupArchivedFiles(?int $daysToKeep)`: Remove old archived files
- `getStatistics()`: Get processing statistics

### LaminasSystemServerService
Manages server entity operations.

### ComposerModuleService
Manages Composer package information and statistics.

## Cronjobs

### SaveSystemdatasTask

**Purpose**: Processes incoming system information files.

**Features:**
- Scans `data/sysmoddatas/systems/` for JSON files
- Processes oldest files first (FIFO)
- Respects batch size limit (default: 50 files)
- Skips duplicate files based on content hash
- Archives successfully processed files
- Logs all operations
- Handles errors gracefully

**Execution Flow:**
1. Scan systems directory for JSON files
2. Calculate MD5 hash for each file
3. Check if hash already processed
4. Process up to max_files_per_run unprocessed files
5. Archive successful files (if enabled)
6. Mark all files as processed in database
7. Log statistics and results

### CleanupProcessedFilesTask

**Purpose**: Maintains data hygiene by removing old records and files.

**Features:**
- Removes database records older than retention period
- Deletes archived files older than retention period
- Only removes successfully processed records
- Provides cleanup statistics
- Logs all operations

**Execution Flow:**
1. Calculate cutoff date based on retention_days
2. Delete old successful records from database
3. Scan and delete old files from processed directory
4. Log statistics
5. Return cleanup summary

## API Endpoints

### Receive System Information

**Endpoint**: `/sysModOverview/receive-system-infos`  
**Method**: POST  
**Authentication**: None (guest accessible)  
**Content-Type**: application/json

**Request Format:**
Send a JSON file containing system information. The exact format depends on your remote collection script.

**Response:**
Returns JSON acknowledgment of receipt.

## Testing

### Running Tests

```bash
# Run all tests
composer test

# Run with coverage
composer test-coverage

# Check code style
composer cs-check

# Fix code style
composer cs-fix

# Run all checks
composer check
```

### Test Structure

```
test/
└── src/
    ├── Entity/
    │   ├── ProcessedFileTest.php
    │   └── LaminasSystemLogTest.php
    └── ModuleTest.php
```

### Writing Tests

Tests use PHPUnit 10+ and follow PSR-4 autoloading:

```php
namespace WirklichDigital\SystemModuleOverviewTest\Entity;

use PHPUnit\Framework\TestCase;
use WirklichDigital\SystemModuleOverview\Entity\ProcessedFile;

class ProcessedFileTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $entity = new ProcessedFile();
        $entity->setFilename('test.json');
        
        $this->assertEquals('test.json', $entity->getFilename());
    }
}
```

## Documentation

### Available Documentation

- **README.md** (this file): Module overview and usage guide
- **IMPLEMENTATION_SUMMARY.md**: Detailed implementation guide covering requirements, configuration, and troubleshooting
- **CHANGES.md**: Comprehensive changelog of all features and improvements

### Code Documentation

All public methods include PHPDoc blocks:

```php
/**
 * Mark file as processed in database
 * Handles duplicate hash errors gracefully (race condition protection)
 *
 * @param string $filename Original filename
 * @param string $filePath Full file path
 * @param string $fileHash MD5 hash of file content
 * @param string $status Processing status ('success' or 'error')
 * @param string|null $errorMessage Error message if status is 'error'
 * @return void
 */
private function markFileAsProcessed(/* ... */): void
```

## Monitoring & Troubleshooting

### Log Locations

All logs are stored in the `LaminasSystemLog` database table. You can query logs:

```php
// Get recent error logs
$logs = $entityManager->getRepository(LaminasSystemLog::class)
    ->findBy(['level' => 'error'], ['createdAt' => 'DESC'], 50);
```

### Common Issues

#### Files not being processed

**Symptoms**: Files remain in `data/sysmoddatas/systems/`

**Solutions:**
1. Check directory permissions (755 required)
2. Verify cronjob is running: check cron scheduler status
3. Check logs for errors
4. Verify JSON file format is valid

#### Duplicate processing

**Symptoms**: Same data appears multiple times

**Solutions:**
1. Check database for unique constraint on `ProcessedFile.fileHash`
2. Verify hash calculation is working correctly
3. Check for database migration completion

#### Performance issues

**Symptoms**: Processing takes too long or times out

**Solutions:**
1. Reduce `max_files_per_run` in configuration
2. Enable file archiving to reduce directory size
3. Run cleanup task more frequently
4. Check database indexes are created
5. Monitor server resources (CPU, memory, disk I/O)

### Statistics & Health Checks

Get processing statistics:

```php
$stats = $cleanupService->getStatistics();
// Returns:
// - total_files: Total number of processed files
// - successful_files: Number of successfully processed files
// - failed_files: Number of failed files
// - latest_processed_at: DateTime of last processed file
// - latest_processed_file: Filename of last processed file
```

## Performance Considerations

### Batch Processing
- Default batch size of 50 prevents memory exhaustion
- Adjust based on file sizes and server capacity
- Smaller batches = more stable, but slower overall throughput

### Database Optimization
- Indexes on frequently queried fields (fileHash, status, processedAt)
- Transaction-based processing ensures data integrity
- Query optimization uses findOneBy for single-record lookups

### File Operations
- Move operation instead of copy for archiving (faster)
- Minimal file reads (hash only for duplicate check)
- Directory scanning optimized to skip non-JSON files

### Scalability
- Horizontal scaling possible with shared database
- Race condition handling allows multiple workers
- Stateless design enables load balancing

## Best Practices

### For Production Deployments

1. **Enable file archiving**: Prevents reprocessing and maintains audit trail
2. **Configure retention policies**: Balance storage costs with audit requirements
3. **Monitor cronjob execution**: Set up alerts for failed jobs
4. **Regular cleanup**: Enable CleanupProcessedFilesTask
5. **Database backups**: Regular backups of tracking data
6. **Monitor disk space**: Archive directory can grow large

### For Development Environments

1. **Reduce batch sizes**: Easier debugging with smaller batches
2. **Increase logging**: Set log level to debug
3. **Disable cleanup**: Keep all data for analysis
4. **Test error handling**: Intentionally create malformed files
5. **Use test databases**: Don't pollute production data

## Security Considerations

- Input validation prevents malformed data injection
- Filename sanitization prevents path traversal attacks
- Database queries use parameterized statements (Doctrine ORM)
- Guest access to API endpoint should be reviewed for production use
- File permissions restrict access to sensitive directories

## Contributing

### Code Standards

- Follow PSR-12 coding standards
- Use PHP 8.1+ features appropriately
- Write tests for new functionality
- Document public APIs with PHPDoc
- Run `composer check` before committing

### Development Workflow

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Write/update tests
5. Run code quality checks
6. Submit a pull request

## Support

For issues, questions, or contributions:

- **Repository**: Check the main repository for issues and PRs
- **Documentation**: Review IMPLEMENTATION_SUMMARY.md for detailed guidance
- **Logs**: Check LaminasSystemLog for error details

## License

This module is developed by Wirklich Digital.

**Author**: Wirklich Digital  
**Email**: info@wirklich.digital  
**Type**: Library  
**Namespace**: WirklichDigital\SystemModuleOverview

---

## Quick Start

### 1. Install
```bash
composer require wirklich-digital/system-module-overview
```

### 2. Configure
```php
// config/autoload/local.php
return [
    'wirklich-digital' => [
        'system-module-overview' => [
            'processing' => [
                'max_files_per_run' => 50,
                'archive_processed_files' => true,
                'retention_days' => 30,
            ],
        ],
    ],
];
```

### 3. Run Migrations
```bash
php vendor/bin/doctrine-module migrations:migrate
```

### 4. Set Up Directories
```bash
mkdir -p data/sysmoddatas/{systems,processed}
chmod 755 data/sysmoddatas/{systems,processed}
```

### 5. Access UI
Navigate to `/sysModOverview/system/list` in your browser.

---

**Version**: 1.x-dev  
**Laminas Module**: WirklichDigital\SystemModuleOverview  
**Requires**: PHP 8.1+, Laminas Framework, Doctrine ORM