# Restlytics - Laravel


## About

Restlytics tracks all requests for analytics that provide detailed informations needed to prioritize, identify, reproduce and improve.

## Features

* Tracks all requests for analytics

## Installation

Require the `restlytics/laravel` package in your `composer.json` and update your dependencies:
```sh
$ composer require restlytics/laravel
```

## Middleware

```
protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
	    Restlytics::class,
    ];
```

## Configuration

The defaults are set in `config/restlytics.php`. Copy this file to your own config directory to modify the values. You can publish the config using this command:
```sh
$ php artisan vendor:publish --provider="Restlytics\ServiceProvider"
```

```php
return [

    /**
     * API Key for the environment
     */
    "api_key" => env("RESTLYTICS_API_KEY"),

    /**
     * API Secret for the environment
     */
    "api_secret" => env("RESTLYTICS_API_SECRET"),

    /**
     * Ignore endpoints
     */
    "ignore_endpoints" => [
        "login",
        "register"
    ],

    /**
     * Ignore headers
     */
    "ignore_headers" => [
        "token"
    ],

    /**
     * Ignore request params
     */
    "ignore_request_params" => [
        "password"
    ],
];
```
