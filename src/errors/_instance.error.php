<?php

namespace SKP_API\Errors;

use OpenApi\Attributes as OA;
use JetBrains\PhpStorm\NoReturn;

if ( !class_exists('\SKP_API\Errors\Error') ) {
    #[OA\Schema(type: "object")]
    class Error {
        #[OA\Property(property: "status", type: "integer", example: 500)]
        public int $code = 500;
        #[OA\Property(property: "message", type: "string")]
        public string $message = 'Unknown error';

        #[NoReturn]
        public function __construct()
        {
            http_response_code($this->code);
            header('Content-Type: application/json; charset=utf-8');
            echo $this->get_details();
            die($this->code);
        }

        private function get_details(): string
        {
            return json_encode(get_object_vars($this));
        }
    }
}