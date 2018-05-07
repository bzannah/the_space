#!/usr/bin/env bash

PROJECT="$(dirname $(cd "$(dirname "$0")" ; pwd))"

if hash php-cs-fixer 2>/dev/null; then
    php-cs-fixer fix --rules=@PSR2 --verbose -- ${PROJECT}/src
    php-cs-fixer fix --rules=@PSR2 --verbose -- ${PROJECT}/tests
else
    echo
    echo "It seems you don't have php-cs-fixer installed!"
    echo
    echo "On MacOS/Homebrew you can easily do so by typing:"
    echo "brew install php-cs-fixer"
    echo
fi
