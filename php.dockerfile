FROM php:7.0-fpm

# bind app folder
WORKDIR /var/www/app
ADD ./app /var/www/app


# update apt
RUN apt-get update


# configure php pdo dep
RUN docker-php-ext-install pdo pdo_mysql


# copy tasks script
COPY ./docker/tasks/tasks.sh /tasks.sh
RUN chmod 0755 /tasks.sh
