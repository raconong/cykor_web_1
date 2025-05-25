#!/bin/bash

echo "Waiting for MySQL to be ready..."

# 포트 3306에 연결 가능할 때까지 기다림
until mysqladmin ping -h db -u root -p"$MYSQL_ROOT_PASSWORD" --silent; do
    echo "Still waiting..."
    sleep 2
done

echo "Running init_admin.php..."
php /var/www/html/init_admin.php

echo "Starting Apache..."
exec apache2-foreground
