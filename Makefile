.DEFAULT_GOAL= help

## -------------------------------------------------Docker-------------------------------------------------

install-application: docker-pull deps-install doctrine-database-create doctrine-migrations-migrate doctrine-fixtures-load cache-clear ##  Install application to <env> environment (Default <env> = dev)
	@printf " - Successful ${VIOLET}install${RESET} project\n"
	@printf " - Successful ${VIOLET}install${RESET} project\n"

deps-install: ##  Install dependencies PHP
	@docker-compose exec -T server composer install

deps-update: ##  Update dependencies PHP
	@docker-compose exec -T server composer update

docker-pull: ##  Pull all docker images
	@docker-compose up -d


start: ##  Start application
	@docker-compose up -d
	@printf " - Successful ${VIOLET}start application${RESET} project\n"
	@printf " - Welcome !! The project is available on this url: ${GREEN}http://127.0.0.1:8085/login${RESET}\n"
	@printf " - PHPMYADMIN is available on this url: ${GREEN}http://127.0.0.1:8080${RESET} user : root, password : '' \n"

docker-status: ##  Display status of all docker container as running
	@docker-compose ps

docker-logs: ##  Display logs of all docker container as running
	@docker-compose logs -f

stop: ##  Stop application
	@docker-compose  down

## -------------------------------------------------Cache-------------------------------------------------

cache-clear: ##  Clear the cache
	@docker-compose exec -T server php bin/console cache:clear

## -------------------------------------------------Config-------------------------------------------------

config-dump-reference : ##  Dump the default configuration for an extension
	@docker-compose exec -T server php bin/console config:dump-reference

#dbal

dbal-run-sql : ##  Executes arbitrary SQL directly from the command line.
	@docker-compose exec -T server php bin/console dbal:run-sql

#debug

debug-autowiring : ##  List classes/interfaces you can use for autowiring
	@docker-compose exec -T server php bin/console debug:autowiring


debug-config : ##  Dump the current configuration for an extension
	@docker-compose exec -T server php bin/console debug:config

debug-container : ##  Display current services for an application
	@docker-compose exec -T server php bin/console debug:container

debug-event-dispatcher : ##  Display configured listeners for an application
	@docker-compose exec -T server php bin/console debug:event-dispatcher

debug-firewall: ##  Display information about your security firewall(s)
	@docker-compose exec -T server php bin/console debug:firewall


debug-form : ##  Display form type information
	@docker-compose exec -T server php bin/console debug:form

debug-router : ##  Display current routes for an application
	@docker-compose exec -T server php bin/console debug:router

debug-translation : ##  Display translation messages information
	@docker-compose exec -T server php bin/console debug:translation

debug-twig: ##  Show a list of twig functions, filters, globals and tests
	@docker-compose exec -T server php bin/console debug:twig

debug-validator: ##  Display validation constraints for classes
	@docker-compose exec -T server php bin/console debug:twig

## -------------------------------------------------Doctrine-------------------------------------------------

doctrine-cache-clear-collection-region: ##  Clear a second-level cache collection region
	@docker-compose exec -T server php bin/console doctrine:cache:clear-collection-region

#
doctrine-cache-clear-entity-region: ##  Clear a second-level cache entity region
	@docker-compose exec -T server php bin/console doctrine:cache:clear-entity-region

doctrine-cache-clear-metadata: ##  Clears all metadata cache for an entity manager
	@docker-compose exec -T server php bin/console doctrine:cache:clear-metadata

doctrine-cache-clear-query: ##  Clears all query cache for an entity manager
	@docker-compose exec -T server php bin/console doctrine:cache:clear-query

doctrine-cache-clear-query-region: ##  Clear a second-level cache query region
	@docker-compose exec -T server php bin/console doctrine:cache:clear-query-region

doctrine-cache-clear-result: ##  Clears result cache for an entity manager
	@docker-compose exec -T server php bin/console doctrine:cache:clear-result

doctrine-database-create: ##  Creates the configured database
	@docker-compose exec -T server php bin/console doctrine:database:create

doctrine-database-drop: ##  Drops the configured database
	@docker-compose exec -T server php bin/console doctrine:database:drop -f


doctrine-database-import: ##  Import SQL file(s) directly to Database.
	@docker-compose exec -T server php bin/console doctrine:database:import

doctrine-ensure-production-settings: ##  Verify that Doctrine is properly configured for a production environment
	@docker-compose exec -T server php bin/console doctrine:ensure-production-settings

doctrine-mapping-convert: ##  [orm:convert:mapping] Convert mapping information between supported formats
	@docker-compose exec -T server php bin/console doctrine:mapping:convert

doctrine-mapping-import: ##  Imports mapping information from an existing database
	@docker-compose exec -T server php bin/console doctrine:mapping:import

doctrine-mapping-info: ##  Mapping info
	@docker-compose exec -T server php bin/console doctrine:mapping:info

doctrine-migrations-current: ##  [current] Outputs the current version
	@docker-compose exec -T server php bin/console doctrine:migrations:current

doctrine-migrations-diff: ##  [diff] Generate a migration by comparing your current database to your mapping information.
	@docker-compose exec -T server php bin/console doctrine:migrations:diff

doctrine-migrations-dump-schema: ##  [dump-schema] Dump the schema for your database to a migration.
	@docker-compose exec -T server php bin/console doctrine:migrations:dump-schema

doctrine-migrations-execute: ##  [execute] Execute one or more migration versions up or down manually.
	@docker-compose exec -T server php bin/console doctrine:migrations:execute

doctrine-migrations-generate: ##  [generate] Generate a blank migration class.
	@docker-compose exec -T server php bin/console doctrine:migrations:generate

doctrine-migrations-latest: ##  [latest] Outputs the latest version
	@docker-compose exec -T server php bin/console doctrine:migrations:latest

doctrine-migrations-list: ##  [list-migrations] Display a list of all available migrations and their status.
	@docker-compose exec -T server php bin/console doctrine:migrations:list

doctrine-migrations-migrate: ##  [migrate] Execute a migration to a specified version or the latest available version.
	@docker-compose exec -T server php bin/console doctrine:migrations:migrate

doctrine-migrations-rollup: ##  [rollup] Rollup migrations by deleting all tracked versions and insert the one version that exists.
	@docker-compose exec -T server php bin/console doctrine:migrations:rollup

doctrine-migrations-status: ##  [status] View the status of a set of migrations.
	@docker-compose exec -T server php bin/console doctrine:migrations:status

doctrine-migrations-sync-metadata-storage: ##  [sync-metadata-storage] Ensures that the metadata storage is at the latest version.
	@docker-compose exec -T server php bin/console doctrine:migrations:sync-metadata-storage

doctrine-migrations-up-to-date: ##  [up-to-date] Tells you if your schema is up-to-date.
	@docker-compose exec -T server php bin/console doctrine:migrations:up-to-date

doctrine-migrations-version: ##  [version] Manually add and delete migration versions from the version table.
	@docker-compose exec -T server php bin/console doctrine:migrations:version

doctrine-query-dql: ##  Executes arbitrary DQL directly from the command line
	@docker-compose exec -T server php bin/console doctrine:query:dql

doctrine-fixtures-load: ##  Load fixture.
	@docker-compose exec -T server php bin/console  doctrine:fixtures:load

## -------------------------------------------------Lint-------------------------------------------------

lint-container: ##  Ensure that arguments injected into services match type declarations
	@docker-compose exec -T server php bin/console lint:container

#
lint-twig: ##  Lint a Twig template and outputs encountered errors
	@docker-compose exec -T server php bin/console lint:twig

lint-xliff: ##  Lint an XLIFF file and outputs encountered errors
	@docker-compose exec -T server php bin/console lint:xliff

lint-yaml: ##  Lint a YAML file and outputs encountered errors
	@docker-compose exec -T server php bin/console lint:xliff

## -------------------------------------------------Make Symfony-------------------------------------------------

make-admin-crud: ##  Creates a new EasyAdmin CRUD controller class
	@docker-compose exec -T server php bin/console make:admin:crud

make-admin-dashboard: ##  Creates a new EasyAdmin Dashboard class
	@docker-compose exec -T server php bin/console make:admin:dashboard

make-admin-migration: ##  Migrates EasyAdmin2 YAML config into EasyAdmin 3 PHP config classes
	@docker-compose exec -T server php bin/console make:admin:migration

make-auth: ##  Creates a Guard authenticator of different flavors
	@docker-compose exec -T server php bin/console make:auth

make-command: ##  Creates a new console command class
	@docker-compose exec -T server php bin/console make:command

make-controller: ##  Creates a new controller class
	@docker-compose exec -T server php bin/console make:command

make-crud: ##  Creates CRUD for Doctrine entity class
	@docker-compose exec -T server php bin/console make:crud

make-entity: ##  Creates or updates a Doctrine entity class, and optionally an API Platform resource
	@docker-compose exec -T server php bin/console make:entity

make-fixtures: ##  Creates a new class to load Doctrine fixtures
	@docker-compose exec -T server php bin/console make:fixtures

make-form: ##  Creates a new form class
	@docker-compose exec -T server php bin/console make:form

make-message: ##  Creates a new message and handler
	@docker-compose exec -T server php bin/console make:message

make-messenger-middleware: ##  Creates a new messenger middleware
	@docker-compose exec -T server php bin/console make:messenger-middleware

make-migration: ##  Creates a new migration based on database changes
	@docker-compose exec -T server php bin/console make:migration

make-registration-form: ##  Creates a new registration form system
	@docker-compose exec -T server php bin/console make:registration-form

make-reset-password: ##  Create controller, entity, and repositories for use with symfonycasts/reset-password-bundle
	@docker-compose exec -T server php bin/console make:reset-password

make-serializer-encoder: ##  Creates a new serializer encoder class
	@docker-compose exec -T server php bin/console make:serializer:encoder

make-serializer-normalizer: ##  Creates a new serializer normalizer class
	@docker-compose exec -T server php bin/console make:serializer:normalizer

make-subscriber: ##  Creates a new event subscriber class
	@docker-compose exec -T server php bin/console make:subscriber

make-test: ##  [make:unit-test|make:functional-test] Creates a new test class
	@docker-compose exec -T server php bin/console make:subscriber

make-twig-extension: ##  Creates a new Twig extension class
	@docker-compose exec -T server php bin/console make:twig-extension

make-user: ##  Creates a new security user class
	@docker-compose exec -T server php bin/console make:user

make-validator: ##  Creates a new validator and constraint class
	@docker-compose exec -T server php bin/console make:validator

make-voter: ##  Creates a new security voter class
	@docker-compose exec -T server php bin/console make:voter

## -------------------------------------------------Router-------------------------------------------------

router-match: ##  Help debug routes by simulating a path info match
	@docker-compose exec -T server php bin/console router:match

## -------------------------------------------------Secrets-------------------------------------------------

secrets-decrypt-to-local: ##  Decrypt all secrets and stores them in the local vault
	@docker-compose exec -T server php bin/console secrets:decrypt-to-local

secrets-encrypt-from-local : ##  Encrypt all local secrets to the vault
	@docker-compose exec -T server php bin/console secrets:encrypt-from-local

secrets-generate-keys: ##  Generate new encryption keys
	@docker-compose exec -T server php bin/console secrets:generate-keys

secrets-list: ##  List all secrets
	@docker-compose exec -T server php bin/console secrets:list

secrets-remove: ##  Remove a secret from the vault
	@docker-compose exec -T server php bin/console secrets:remove

secrets-set: ##  Set a secret in the vault
	@docker-compose exec -T server php bin/console secrets:set

#security
security-encode-password : ##  Encode a password
	@docker-compose exec -T server php bin/console security:encode-password

security-hash-password: ##  Hash a user password
	@docker-compose exec -T server php bin/console security:hash-password

## -------------------------------------------------Translation-------------------------------------------------

translation-pull: ##  Pull translations from a given provider.
	@docker-compose exec -T server php bin/console translation:pull

translation-push: ##  Push translations to a given provider.
	@docker-compose exec -T server php bin/console translation:push

translation-update: ##  Update the translation file
	@docker-compose exec -T server php bin/console translation:update

## -------------------------------------------------End-------------------------------------------------------

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-45s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

GREEN  := $(shell tput -Txterm setaf 2)
YELLOW := $(shell tput -Txterm setaf 3)
WHITE  := $(shell tput -Txterm setaf 7)
VIOLET := $(shell tput -Txterm setaf 5)
BlUE := $(shell tput -Txterm setaf 4)
RESET  := $(shell tput -Txterm sgr0)

