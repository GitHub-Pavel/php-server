<?php

namespace SKP_API\Errors;

use JetBrains\PhpStorm\NoReturn;

if ( !class_exists('\SKP_API\Errors\Bad_Request') ) {
    class Bad_Request extends \SKP_API\Classes\Error {
        #[NoReturn]
        public function __construct($message = 'Bad request')
        {
            $this->code = 400;
            $this->message = $message;

            parent::__construct();
        }
    }
}