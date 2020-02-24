# Salto Test Assessment

This project was built based on the test challenge and provides an application with the simulation of the unlock door functionality.

## Architecture

#### Folders structure

- `src` - main folder with source code
- `nginx` - Nginx configuration files
- `docker-compose.yml` - Docker Compose file
- `Dockerfile` - Docker file for PHP container
- `Makefile` - Makefile with CLI commands aliases

#### Main concepts and ideas

- `Authorization` - Oauth was used (Laravel Passport library, adopted for Lumen) for the users authorization.
- `Permissions` - Oauth scopes were used for the simplifying permissions handling and supporting scalability. 
- `History` - Basic in-built events functionality was used for the catching users actions (unlock operations). 
For the storing - [ActivityLog](https://github.com/spatie/laravel-activitylog) library.

### Prerequisites

For development and testing purposes please be sure that `Docker` is installed on your local machine.
For the simplifying CLI commands `make` command will be used.

## Getting Started

For the building project please run:
```
make install-project
```

Other valuable commands:
- `make stop` - stop the project
- `make restart` - restart the project
- `make ssh` - connect to the container
- `make logs` - view logs of the container

Please notice that Alpine PHP image was used for the decreasing size of the image

## Running the tests

For the running `PHPUnit` tests:
```
make phpunit
```

### And coding style tests

Commands for code styles analyzers:

- `make phpcs` - run `PHP_CodeSniffer`
- `make phpmd` - run `PHP Mess Detector`
- `make phpcpd` - run `PHP Copy/Paste Detector `

## Built With

* [PHP 7.4](https://www.php.net/docs.php) - Programming language version
* [Composer](https://getcomposer.org/) - Dependency Management
* [Lumen](https://lumen.laravel.com//) - Micro PHP framework (powered by Laravel)
* [PHPUnit](https://phpunit.de/) - Testing framework

## Contributing

When contributing to this repository, please first discuss the change you wish to make via issue, email, or any other method with the owners of this repository before making a change.
Also, please review the list of main ideas and patterns which were used during the project development.
 
## Roadmap
- Implement API documentation
- Improve tests coverage
- Integrate `real` unlock functionality
- Set up CD/CI
 
## Authors

* **Rustem Yusupov** - *Initial work*
