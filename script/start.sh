#!/bin/bash

# !!! Please run this file in root project folder
# This file is a shortcut for `docker-compose up`
# USAGE:
# $ script/start.sh [environment]
# EG:
# $ script/start.sh 
# $ script/start.sh dev

environment=$1
case "$environment" in
    dev)
        docker-compose --env-file ./src/.env -f docker-compose.yml -f docker-compose.dev.yml up -d
        ;;
     
    staging)
        docker-compose --env-file ./src/.env -f docker-compose.yml -f docker-compose.staging.yml up -d
        ;;
     
    *)
        docker-compose --env-file ./src/.env -f docker-compose.yml up -d
esac