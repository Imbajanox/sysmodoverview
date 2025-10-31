# SystemModuleOverview

## Overview

The SystemModuleOverview module collects and manages system information from Laminas-based applications. It receives data via a public route and processes it through a cronjob system.

## How It Works

### Data Collection Flow

1. **Data Reception**: Remote Laminas systems send their module and system information to the `/sysModOverview/receive-system-infos` endpoint
2. **File Storage**: Received data is stored as JSON files in `data/sysmoddatas/systems/`
3. **Cronjob Processing**: A cronjob (`SaveSystemdatasTask`) runs hourly to process these files
4. **Database Storage**: Processed data is stored in the database
5. **File Archiving**: Successfully processed files are moved to `data/sysmoddatas/processed/`

### Batch Processing

The cronjob implements batch processing to prevent overload:
- **Maximum Files Per Run**: Configurable limit (default: 50 files)
- **Oldest First**: Files are processed in order of modification time (oldest first)
- **Tracking**: Each file's hash is stored to prevent reprocessing

### Duplicate Prevention

The system tracks processed files using MD5 hashes:
- Files with the same hash (content) are not reprocessed
- Processing status (success/error) is logged in the database
- Error messages are stored for debugging

## Configuration

Configuration options are available in `module.config.php`:

```php
'wirklich-digital' => [
    'system-module-overview' => [
        'processing' => [
            'max_files_per_run' => 50,           // Maximum files to process per cronjob run
            'archive_processed_files' => true,   // Whether to archive processed files
            'retention_days' => 30,              // Days to keep processed files and records
        ],
    ],
],
```

### Cronjobs

Two cronjobs are available:

1. **SaveSystemdatasTask** (enabled by default)
   - Schedule: Every minute (`* * * * *`)
   - Purpose: Process incoming system data files
   
2. **CleanupProcessedFilesTask** (disabled by default)
   - Schedule: Daily at 2 AM (`0 2 * * *`)
   - Purpose: Clean up old processed files and database records
   - Enable in config when needed for automatic cleanup

## Database Entities

- **ProcessedFile**: Tracks file processing status
  - `filename`: Name of the processed file
  - `filePath`: Full path to the file
  - `fileHash`: MD5 hash for duplicate detection
  - `processedAt`: Timestamp of processing
  - `status`: Processing status (success/error)
  - `errorMessage`: Error details if processing failed

## Cronjob

The `SaveSystemdatasTask` cronjob:
- Runs every minute (configurable via cron-scheduler)
- Processes up to `max_files_per_run` files per execution
- Logs all processing activities
- Handles errors gracefully without stopping the entire batch

The `CleanupProcessedFilesTask` cronjob (optional):
- Runs daily at 2 AM by default (disabled by default)
- Removes old processed file records from database
- Deletes old archived files from filesystem
- Retention period is configurable via `retention_days` setting

## Monitoring

Check the logs for processing status:
- Successful processing: `SaveSystemdatasTask: Successfully processed file 'filename.json'`
- Errors: `SaveSystemdatasTask: Error processing file 'filename.json': error message`
- Batch summary: Shows total files processed, errors, and skipped files