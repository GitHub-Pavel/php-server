<?php

namespace SKP_API\Errors;

use JetBrains\PhpStorm\NoReturn;

if ( !class_exists('\SKP_API\Errors\Error') ) {
    class Error {
        public int $code = 500;
        public string $message = 'Unknown error';

        #[NoReturn]
        public function __construct()
        {
            http_response_code($this->code);
            header('Content-Type: application/json; charset=utf-8');

            echo $this->getDetails();
            die($this->code);
        }

        private function getDetails(): string
        {
            return json_encode([
                'code' => $this->code,
                'message' => $this->message,
            ]);
        }
    }
}