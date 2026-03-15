#!/usr/bin/env sh
set -e

php artisan migrate --force

php artisan storage:link || true

exec apache2-foreground
