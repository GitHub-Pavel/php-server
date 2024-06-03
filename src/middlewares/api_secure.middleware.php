<?php

use SKP_API\Classes\Request;
use SKP_API\Classes\Response;
use SKP_API\Errors\Forbidden;

if ( !function_exists('api_secure') ) {
    function api_secure(): Closure
    {
        return function (Request $request): void
        {
            $api_key = $request->headers->get('X-Api-Key');

            if ( $api_key !== API_KEY && is_api($request) ) {
                new Forbidden();
            }
        };
    }
}