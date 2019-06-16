#!/bin/bash

# function to display commands
exe() { echo "\$ $@" ; "$@"; }

# local configuration
path="$(pwd)"

# load variables from .env file
export $(cat variables.env | xargs)

# process deploy
exe docker-compose exec mysql mysqldump -u"${MYSQL_ROOT_USER}" -p"${MYSQL_ROOT_PASSWORD}" "${MYSQL_DATABASE}" > "${1}"/data.sql