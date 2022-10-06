#!/usr/bin/env bash
php artisan clear-compiled && \
git pull && \
composer i -o && \
php artisan clear-compiled && \
php artisan config:cache && \
php artisan route:cache && \
php artisan migrate && \
php artisan queue:restart
