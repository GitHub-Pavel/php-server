<?php

use SKP_API\Files_System;
use SKP_API\Classes\Request;
use SKP_API\Classes\Response;


if ( !function_exists('set_public') ) {
    function set_public(): Closure
    {
        return function(Request $request, Response $response): void
        {
            if ( !is_dir( Files_System::getPath(PUBLIC_FOLDER) ) ) {
                mkdir( Files_System::getPath(PUBLIC_FOLDER) );
            }

            if ( $request->method !== 'GET' || is_api($request) ) {
                return;
            }

            $response->file($request->location->pathname);
        };
    }
}