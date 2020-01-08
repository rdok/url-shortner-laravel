pipeline {
    agent { label "rdok.dev" }
    options {
        buildDiscarder( logRotator( numToKeepStr: '5' ) )
        disableConcurrentBuilds()
    }
    triggers { 
        githubPush() 
        cron('H H(18-19) * * *')
    }
    environment {
        DB_PASSWORD = credentials('db-password')
        VIRTUAL_HOST = 'url-shortner-laravel.rdok.dev'
        VIRTUAL_PORT = '3009'
        LETSENCRYPT_HOST = 'url-shortner-laravel.rdok.dev'
        LETSENCRYPT_EMAIL = credentials('rdok-email')
        DEFAULT_EMAIL = credentials('rdok-email')
        COMPOSE_PROJECT_NAME = 'url-shortner-laravel'
        APP_KEY = credentials('app-key')
    }
    stages {
        stage('Build') {
            steps {
                sh"""#!/bin/bash -xe
                docker-compose --project-directory "${WORKSPACE}" \
                    -f docker/docker-compose.yml build

                docker-compose --project-directory "${WORKSPACE}" \
                    --file docker/src/docker-compose.yml build

                docker-compose --project-directory "${WORKSPACE}" \
                    --file docker/docker-compose.yml \
                    --file docker/docker-compose.production.yml \
                    build
                """
            }
        }
        stage('Migrate DB') {
            steps {
                sh"""#!/bin/bash -xe
                docker-compose --project-directory "${WORKSPACE}" \
                    --file docker/docker-compose.yml \
                    --file docker/docker-compose.production.yml \
                     run --rm php php artisan migrate --force
                """
            }
        }
        stage('Up') {
            steps {
                sh"""#!/bin/bash -xe
                docker-compose --project-directory "${WORKSPACE}" \
                    --file docker/docker-compose.yml \
                    --file docker/docker-compose.production.yml \
                    up -d
                """
            }
        }
        stage('Health Check') { steps { build 'health-check' } }
    }

    post {
        failure { slackSend color: '#FF0000', message: "@here Failed: <${env.BUILD_URL}console | ${env.JOB_NAME}#${env.BUILD_NUMBER}>" }
        fixed { slackSend color: 'good', message: "@here Fixed: <${env.BUILD_URL}console | ${env.JOB_NAME}#${env.BUILD_NUMBER}>" }
        success { slackSend message: "Stable: <${env.BUILD_URL}console | ${env.JOB_NAME}#${env.BUILD_NUMBER}>" }
    }
}
