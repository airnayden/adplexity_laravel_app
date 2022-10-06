#! /bin/bash

# Run queue worker
WORK_COMMAND="php artisan queue:work --tries=3 --timeout=115 --memory=256"
echo ${WORK_COMMAND}
eval ${WORK_COMMAND}
