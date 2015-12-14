vendor/bin/doctrine orm:schema-tool:drop --force
vendor/bin/doctrine orm:schema-tool:create

vendor/phpunit/phpunit/phpunit 
rm -Rv data/proxyData/*
