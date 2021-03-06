.DEFAULT_GOAL := help
.PHONY: help test coverage db build

help: ## visualizza questo help
	@awk 'BEGIN {FS = ":.*#"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z0-9_-]+:.*?#/ { printf "  \033[36m%-27s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

test: ## lancia i test
	php vendor/bin/phpunit tests

coverage: ## code coverage
	phpdbg -qrr vendor/bin/phpunit --coverage-html build/coverage-report

build: ## build del progetto
	composer install
	vendor/bin/phinx migrate -e testing
	php vendor/bin/phpunit --testdox tests

