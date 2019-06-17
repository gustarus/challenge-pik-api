# Challenge Pik Api
Yii2 implementation for [api.challenge-pik.webulla.ru](https://api.challenge-pik.webulla.ru).
Wrapped with Docker: nginx, php-fpm, mysql. 

## Installation
1. Up the docker.
```bash
docker-compose up
```

2. Run dektrium/user module migrations
```bash
docker-compose run --rm php php yii migrate --interactive=0 --migrationPath=@vendor/dektrium/yii2-user/migrations
```

3. Run app migrations
```bash
docker-compose run --rm php php yii migrate --interactive=0
```

3. Setup crontab
```bash
crontab -e
```

Insert the following lines to crontab:
```bash
# [tripstips]->[api] sync treasures
*/5 * * * * cd /path/to/app && /usr/bin/docker-compose -f docker-compose.yml -f docker-compose.prod.yml run php /tasks.sh > /dev/null 2>&1
```

4. Set permissions.
```bash
chown -R www-data:www-data .
```

## Deploy
1. Copy .env variables file.
```bash
cp .env.example .env
```

2. Set your variables in .env file.
```bash
subl .env
```

3. Run the deploy script.
```bash
sh deploy.sh
```

4. Go to the remote host
```bash
ssh user@host
```

5. Login as root.
```bash
su root
```

6. Go to the project folder.
```bash
cd /home/user/www/site
```

7. Set files permissions.
```bash
chown -R www-data:www-data .
```
 
## Usage
1. Up the docker.
```bash
docker-compose up
```

2. Open the browser.
```bash
open localhost:3000
```

## Clean docker data
1. Login as root.
```bash
su root
```

2. Clean up runtime folder.
```bash
rm -rf app/runtime/cache/*
rm -rf app/runtime/debug/*
rm -rf app/runtime/logs/*
```

3. Clean up assets folder.
```bash
rm -rf app/web/assets/*
```

## Q&A
### How to run custom command in docker container?
Run the command `migrate` with arguments `--interactive=0` in container `php`.
```bash
docker-compose run --rm php php yii migrate --interactive=0
```

Or require a package via composer.
```bash
docker-compose run --rm composer require richardfan1126/yii2-sortable-gridview "*"
```

Or login into mysql server.
```bash
docker-compose run mysql mysql -uroot -proot
```
