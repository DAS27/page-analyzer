![PHP CI](https://github.com/DAS27/php-project-lvl3/workflows/PHP%20CI/badge.svg)
[![Maintainability](https://api.codeclimate.com/v1/badges/83d1974715051eb3dd52/maintainability)](https://codeclimate.com/github/DAS27/php-project-lvl3/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/83d1974715051eb3dd52/test_coverage)](https://codeclimate.com/github/DAS27/php-project-lvl3/test_coverage)

## App on heroku
[Page Analyzer](https://peaceful-stream-47620.herokuapp.com/)

## Description
SEO page analyzer. Made on Laravel.
Check domain availability, track SEO attributes (H1, Keywords, Description) history
Ready to deploy on Heroku

## Requirements
- PHP 7.4
- Extensions: mbstring, curl, dom, xml,zip, sqlite3, pgsql
- SQLite for local
- Composer
- [heroku cli](https://devcenter.heroku.com/articles/heroku-cli#download-and-install)

## Setup
````
$ make setup
````

## Launch local
Server will be available at http://localhost:8000/
````
$ make start
````

## Run tests
````
$ make test
$ make test-coverage
````

## Run linter
````
$ make lint
````

## Deploy on heroku
````
$ make deploy
````
