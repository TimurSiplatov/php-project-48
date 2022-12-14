install: # установка зависимостей
	composer install
lint: # линтер
	composer exec --verbose phpcs -- --standard=PSR12 src bin
test: # тесты
	composer exec --verbose phpunit tests/test.php
coverage: # покрытие
	composer exec --verbose XDEBUG_MODE=coverage phpunit tests -- --coverage-clover build/logs/clover.xml