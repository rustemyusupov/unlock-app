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

Please review `Makefile` for all available CLI commands.
Please notice that Alpine PHP image was used for the decreasing size of the image.
Please notice that you will need `Client ID` and `Client Secret`. You can find it in the database table `oauth_clients`. In this basic example you need: `Lumen Password Grant Client`.

## Available Endpoints 
- POST: `/oauth/token` - Login

Example request:
```json
  {
  	"client_id": 2,
  	"client_secret": "IYgcsgtJXPKltf3sTkRmab7EmctZD3J98J6objQb",
  	"grant_type": "password",
  	"password": "password",
  	"username":"test@test.com",
  	"scope": "open-tunnel open-office"
  }
  ```
Example response:
```json
{
  "token_type": "Bearer",
  "expires_in": 31622400,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNjdkMWZhMDMzYjg5MzFmZjY4MWNhNTA1YjhkZWE5MTQ2MzFlNTM0NzYxYmM5MjEwYTRkZjU3MTQ5ZjUwYTQ4ZGNiMzc5ZTdjMmE0OTI5NTciLCJpYXQiOjE1ODI1NTI2ODIsIm5iZiI6MTU4MjU1MjY4MiwiZXhwIjoxNjE0MTc1MDgyLCJzdWIiOiIxIiwic2NvcGVzIjpbIm9wZW4tdHVubmVsIiwib3Blbi1vZmZpY2UiXX0.X5xqNEKgTB92pKfLHu_Wa8hQxUWqSsfQ0ss9bir0UTcFUA_e1qNVf7LXHTwqkuRegyvIq8fR7kHJ2XgffY0LrWUKXG74uao1eO_7WaGhsVppZ16PQYd_YTg43vCEeiJaO3GToIgeNpQjvSseVrkcLKmIiwR6d0dNcMJUwcyGRoppFDx1furbi0yAbn6SSe2rpETHNSrCNekcWGASKQ9C_ppvxm8ZuRoqEYVCB39BL7L6g8T8oHEj5IVmT5ZkvFi1zt1YSeCeFoPNcS-Wku7hAIgiC0CqSSMmkLqy-amBqfuzTVrXYX2dh9RsOy27bVvUhcS2_9u1KWd5WE4h-Okz9iGWcebTMrBP8IEFgaPNjizbnlRJ3YjoJj2KcvlUuE2ncGxzq8fu_R16RYT5EJkJjAA9H1RdAVk0SpyqLk8PTf-Wed0CXrf7kPzpbWilTUbLcjOa-UfUGtJClFDfzQWvEU7jaKHdsXD2nAYn_5zSsxy76Msu6RIUVb-uw9HNK1wHR81IfZ1qL0fxryBEy8YnxpkT6YEYkLrYUff-mtl0s0_e1ACxEtKpYQzuzIt1EtNXuzkiUIdIwDq4DwY1gMWbnCptL8yr5h47Y5jLdhr5TYN55bkgv76oYAZ8QJfmw-SmUStV0Qyw5KslnXrGBRsa-HpXA0Qv-z8aKCJhCOXu7Cw",
  "refresh_token": "def5020015a9f76f5ecf6c7c95cbeb3bc61f5b7f7350cc7ad70695e0b88fd203ed260de4f66d7b2530c84e07bcf3d5a7b5bf9d9516425bb07207939d7b884c0cac85d43f9499583805c43c09e4b39109f70a5d4a6074843718ef5ec9dfc56812962a7e36b2244c47838900193321eec4344b1659e9c9af96a5741c06329135108b2efc41fa8f768704439dc4f2093d161d86e19e4707d8037f49731f40c7e6f347418c3adea4b4247fccb4dd233e1727c512ed365f8c638a9b9292591fd076f4623dae989aa5e4556ca99fd797a7e8a09f18c12024b7fd913cdf571fbc29baeaab3a6847982793d96320024ea79a5eb883fa69af78686832fd0346693008c9ef8964e4e0511a455a65fd817fd64c5409ca46b4cfa25faa983eeb560be4f45f9b9d1bcf134524642655757dc2b644cef12ea488adae1d47c28ea05479d0b8db3e754ab4cf134ef8105d89c2584527df1017e8981ddad8d1605e3f24d2ee62c4d485f9507a376900652f8ac7e9c7f71b13c34ae0cf0450ac29de28b6e1"
}
```
- POST: `/unlock/{scope}` - Unlock the door. 
Example response:
```json
{
  "success": true
}
```
- GET: `/oauth/scopes` - Get list of all the scopes. 
```json
[
  {
    "id": "open-tunnel",
    "description": "Open 1st door (tunnel)"
  },
  {
    "id": "open-office",
    "description": "Open 2nd door (office)"
  }
]
```
- GET: `/history` - Get list of all users action. 
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 5,
      "log_name": "default",
      "description": "Successful unlock.",
      "subject_id": null,
      "subject_type": null,
      "causer_id": 1,
      "causer_type": "App\\User",
      "properties": [
        {
          "id": "open-office",
          "description": "Open 2nd door (office)"
        }
      ],
      "created_at": "2020-02-24 13:58:21",
      "updated_at": "2020-02-24 13:58:21"
    }
  ],
  "first_page_url": "http:\/\/localhost:8080\/history?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http:\/\/localhost:8080\/history?page=1",
  "next_page_url": null,
  "path": "http:\/\/localhost:8080\/history",
  "per_page": 15,
  "prev_page_url": null,
  "to": 4,
  "total": 4
}
```
## Running the PHPUnit tests

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
