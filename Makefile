#!/bin/sh
GREEN='\033[0;32m'

cp .env.example .env

echo "\n${GREEN}Prepare settings...${NC}"


docker-compose run --rm --no-deps app_multi_language composer install
docker-compose run --rm --no-deps app_multi_language php artisan key:generate
docker-compose run --rm --no-deps app_multi_language php artisan storage:link

echo "\n${GREEN}DONE"

echo "Now run"
docker-compose up -d
echo "${NC}"

sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

docker-compose exec app_multi_language php artisan migrate --seed
docker-compose exec app_multi_language php artisan serve

