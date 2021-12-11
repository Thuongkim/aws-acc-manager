cp -rf docker/nginx/web.Dockerfile . 
cp -rf docker/phpfpm/app.Dockerfile . 
cp -rf docker/mariadb/db.Dockerfile .
docker-compose --env-file ./src/.env build
rm -rf web.Dockerfile 
rm -rf app.Dockerfile
rm -rf db.Dockerfile