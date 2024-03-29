#
# JBZoo PHPUnit
#
# This file is part of the JBZoo CCK package.
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.
#
# @package    PHPUnit
# @license    MIT
# @copyright  Copyright (C) JBZoo.com, All rights reserved.
# @link       https://github.com/JBZoo/PHPUnit
#

.PHONY: build update test-all validate autoload test phpmd phpcs phpcpd phploc reset coveralls

build: update

server:
	@make server-fake-test
	@make server-phpunit

server-fake-test:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Start server (Fake index) \033[0m"
	@chmod +x ./bin/phpunit-server.sh
	@sh ./bin/phpunit-server.sh  "localhost" "8888"     \
        "`pwd`/tests/fixtures/http-root"                \
        "`pwd`/bin/fake-index.php"                      \
        "--index=`pwd`/tests/fixtures/http-root/index.php --cov-src=`pwd`/src --cov-cov=1 --cov-xml=1 --cov-html=1"

server-phpunit:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Start server (PHPUnit) \033[0m"
	@chmod +x ./bin/phpunit-server.sh
	@sh ./bin/phpunit-server.sh  "localhost" "8889"     \
        "`pwd`/tests/webroot"                           \
        "`pwd`/bin/fake-index.php"                      \
        "--index=`pwd`/tests/webroot/index.php --cov-cov=1 --cov-xml=1"

test-all:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Run all tests \033[0m"
	@make clean-build validate test phpmd phpcpd phploc

update:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Update project \033[0m"
	@composer update --optimize-autoloader --no-interaction
	@echo ""

validate:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Composer validate \033[0m"
	@composer validate --no-interaction
	@echo ""

autoload:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Composer autoload \033[0m"
	@composer dump-autoload --optimize --no-interaction
	@echo ""

test:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Run unit-tests \033[0m"
	@php ./vendor/phpunit/phpunit/phpunit --configuration ./phpunit.xml.dist
	@echo ""

phpmd:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Check PHPmd \033[0m"
	@php ./vendor/phpmd/phpmd/src/bin/phpmd ./src text  \
         ./vendor/jbzoo/misc/phpmd/jbzoo.xml --verbose

phpcs:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Check Code Style \033[0m"
	@php ./vendor/squizlabs/php_codesniffer/bin/phpcs ./src     \
        --extensions=php                                        \
        --standard=./vendor/jbzoo/misc/phpcs/JBZoo/ruleset.xml  \
        --report=full
	@echo ""

phpcpd:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Check Copy&Paste \033[0m"
	@php ./vendor/sebastian/phpcpd/phpcpd ./src --verbose
	@echo ""

phploc:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Show stats \033[0m"
	@php ./vendor/phploc/phploc/phploc ./src --verbose
	@echo ""

reset:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Hard reset \033[0m"
	@git reset --hard

clean-build:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Cleanup build directory \033[0m"
	@rm -fr ./build
	@mkdir -pv ./build
	@mkdir -pv ./build/logs

phpcov:
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Merge coverage reports \033[0m"
	@mkdir -pv ./build/coverage_total
	@mkdir -pv ./build/coverage_cov
	@php ./vendor/phpunit/phpcov/phpcov merge       \
        --clover build/coverage_total/merge.xml     \
        --html   build/coverage_total/merge-html    \
        build/coverage_cov                          \
        -v
	@echo ""

coveralls: phpcov
	@echo "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> \033[0;30;46m Send coverage to coveralls.io \033[0m"
	@php ./vendor/satooshi/php-coveralls/bin/coveralls -vvv
	@echo ""
