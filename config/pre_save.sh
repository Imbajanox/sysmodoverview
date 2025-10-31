#!/bin/bash

DB_NAME=$(cat /git/config/j77_project.json | jq -r '.mysql.db')
MYSQL_ROOT_PW=$(cat /git/config/j77_project.json | jq -r '.credentials.mysql_root')

TABLE_NAMES="ApplicationLog
HostRawFact"

for TABLE_NAME in $TABLE_NAMES
do
    echo "Clearing contents of ${TABLE_NAME}";
    echo -e "[client]user=root\npassword=${MYSQL_ROOT_PW}" | mysql --defaults-file=/dev/stdin -D "${DB_NAME}" -e "TRUNCATE ${TABLE_NAME};"
done

