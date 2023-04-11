#!/bin/sh

cd /var/www
chmod 777 /var/www/storage/logs/laravel.log

# php artisan migrate:fresh --seed
php artisan cache:clear
php artisan route:cache

/usr/bin/supervisord -c /etc/supervisord.conf
