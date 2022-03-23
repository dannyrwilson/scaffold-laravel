#!/bin/bash

/usr/bin/php /var/www/artisan storage:link

rm -f /var/run/apache2/apache2.pid

/usr/sbin/apache2ctl -D FOREGROUND
