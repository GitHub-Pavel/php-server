<?php

use SKP_API\Files_System;
use SKP_API\Classes\Request;
use SKP_API\Classes\Response;


if ( !function_exists('set_public') ) {
    function set_public(): Closure
    {
        return function(Request $request, Response $response): void
        {
            $info = pathinfo($request->location->pathname);

            if ( !is_dir( Files_System::get_path(PUBLIC_FOLDER) ) ) {
                mkdir( Files_System::get_path(PUBLIC_FOLDER) );
            }

            if ( $request->method !== 'GET' || is_api($request) || !array_key_exists('extension', $info) ) {
                return;
            }

            $response->file($request->location->pathname);
        };
    }
}