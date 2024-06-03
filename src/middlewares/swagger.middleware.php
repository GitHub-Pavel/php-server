<?php

use OpenApi\Generator;

use OpenApi\Util;
use SKP_API\Errors\Error;
use SKP_API\Classes\Request;
use SKP_API\Classes\Response;

if ( !function_exists('set_swagger') ) {
    function set_swagger(): Closure
    {
        return function(Request $request, Response $response): void
        {
            if ($request->location->pathname === SWAGGER_URL && SWAGGER) {
                $exclude = ['tests', 'vendor'];
                $pattern = '*.php';

                $openapi = Generator::scan(Util::finder(API_DIR, $exclude, $pattern));

                if ( !$openapi ) {
                    new Error();
                }

                $response->json($openapi->toJson());
            }
        };
    }
}