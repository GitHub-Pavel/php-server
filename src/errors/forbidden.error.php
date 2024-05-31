<?php

namespace SKP_API\Errors;

use JetBrains\PhpStorm\NoReturn;

if ( !class_exists('\SKP_API\Errors\Forbidden') ) {
    class Forbidden extends \SKP_API\Classes\Error {
        #[NoReturn]
        public function __construct($message = 'Forbidden')
        {
            $this->code = 403;
            $this->message = $message;

            parent::__construct();
        }
    }
}