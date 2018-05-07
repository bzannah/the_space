#!/bin/bash

bin/console cache:clear

echo "Starting embedded server and running tests..."
php bin/console server:start

vendor/bin/phpunit

echo "Stopping server..."
php bin/console server:stop

echo "Tests done, hopefully successful."
echo
