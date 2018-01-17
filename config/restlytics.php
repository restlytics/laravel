<?php

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
