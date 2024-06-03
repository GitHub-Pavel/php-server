<?php

use SKP_API\Classes\Request;

if ( !function_exists('is_api') ) {
    function is_api(Request $request): bool
    {
        $pathname = $request->location->pathname;
        $pathname_slices = array_slice(explode('/', $pathname), 1);

        if ('/'. implode('/', array_slice($pathname_slices, 0, 2)) === API_URL) {
            return true;
        }

        return false;
    }
}

if ( !function_exists('is_form_data_headers') ) {
    function is_form_data_headers(Request $request): bool
    {
        if ( str_contains( $request->headers->get('Content-Type'), FORM_DATA_TYPE ) ) {
            return true;
        }

        return false;
    }
}