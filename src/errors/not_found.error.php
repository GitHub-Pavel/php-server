<?php

namespace SKP_API\Errors;

use JetBrains\PhpStorm\NoReturn;

if ( !class_exists('\SKP_API\Errors\Not_Found') ) {
    class Not_Found extends \SKP_API\Errors\Error {
        #[NoReturn]
        public function __construct($message = 'Not found')
        {
            $this->code = 404;
            $this->message = $message;

            parent::__construct();
        }
    }
}