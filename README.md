# Exercise for AFW

## Notes on the solution
* This makes use of composer and php-di for dependency injection.
* Additionally composer is used for psr-0 autoloading of libraries.
* Mocking is used in conjunction with DI to make testing easier.

## DI Configuration files 
./config.php (for 'production' version)
./test/config.php (for unit tests)

## Running the unit tests
cd tests
./runtests.sh

## Running the example
php solution.php 1

Merchant ID    Date           Value               
1              01/05/2010     £50.00             
1              02/05/2010     £11.04             
1              02/05/2010     £0.75              
1              03/05/2010     £15.21

php solution.php 2

Merchant ID    Date           Value               
2              01/05/2010     £43.56             
2              02/05/2010     £9.00              
2              02/05/2010     £6.50              
2              04/05/2010     £4.88 




