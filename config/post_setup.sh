#!/bin/bash

npm install -g less

chown www-data:www-data -R /var/www/html

echo "Installiere composer Pakete..."
cd /git/httpdocs
composer install