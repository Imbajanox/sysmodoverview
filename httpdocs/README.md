# wirklich.digital Zend Framework Application

This is a Zend Framework 3 application by wirklich.digital.

## Login credentials

Login credentials can be found in the PMS. The default user is admin@jcdn.de

## Setup

After installation the following steps should be executed:

### Update composer modules

```bash
composer update
```

### Setup Cronjobs
```
* * * * * php /PATH/TO/ZF/PUBLIC/index.php cron-scheduler tick
```

