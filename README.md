Doctrine schéma:
php bin/doctrine orm:schema-tool:update --force

Unit testy:
Create a test using generate:test command with a suite and test names as parameters:

php vendor/bin/codecept generate:test Unit Example

It creates a new ExampleTest file located in the tests/unit directory.

As always, you can run the newly created test with this command:

php vendor/bin/codecept run Unit ExampleTest

Or simply run the whole set of unit tests with:

php vendor/bin/codecept run Unit