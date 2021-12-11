#!/bin/bash

# $ script/artisan.sh <your command>
# EG:
# $ script/artisan.sh migrate

docker-compose exec app php artisan "$@"