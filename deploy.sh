#!/bin/bash

# function to display commands
exe() { echo "\$ $@" ; "$@"; }
remote() { exe ssh ${targetUser}@${targetHost} ${@}; }

# load variables from .env file
export $(cat .env | xargs)

# local configuration
localPath="$(pwd)"

# project configuration
projectName=${NAME}

# target configuration
targetUser=${DEPLOY_USER}
targetHost=${DEPLOY_HOST}
targetPath=${DEPLOY_PATH}


# ask if you want to deploy
read -p 'Do you wish to deploy this project to production (y/n)? ' answer
case ${answer:0:1} in
    y|Y )
        echo Yes;
    ;;
    * )
        echo Stopping...;
        exit;
    ;;
esac


# process deploy
echo "Deploying project ${projectName} to the ${targetHost} with user ${targetUser}..."

echo "\nStepping into root folder..."
exe cd ${localPath}

echo "\nSyncing project folder without files under gitignore..."
exe rsync -az --filter=":- .gitignore" ${localPath}/ ${targetUser}@${targetHost}:${targetPath}

echo "\nLoading container env variables locally..."
exe set -a && . ./variables.env && set +a

echo "\nUpping new containers..."
remote "cd ${targetPath} && docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d"

echo "\nRunning vendors migrations..."
remote "cd ${targetPath} && docker-compose run --rm php php yii migrate --interactive=0 --migrationPath=@vendor/dektrium/yii2-user/migrations"

echo "\nRunning app migrations..."
remote "cd ${targetPath} && docker-compose run --rm php php yii migrate --interactive=0"

echo "\nComplete!"
