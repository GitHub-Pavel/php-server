<?php

namespace SKP_API\Classes;

if ( !class_exists('\SKP_API\Classes\Location') ) {
    class Location {
        public string $pathname;

        public function __construct()
        {
            $this->pathname = $_GET['q'];
        }
    }
}

if ( !class_exists('\SKP_API\Classes\Headers') ) {
    class Headers {
        private array $headers = [];

        public function __construct()
        {
            $headers = apache_request_headers();

            if ($headers) {
                $this->headers = $headers;
            }
        }

        public function get(string $key) {
            return $this->headers[$key] ?? null;
        }
    }
}


if ( !class_exists('\SKP_API\Classes\Request') ) {
    class Request {
        public string $method;
        public Location $location;
        public Headers $headers;
        public array $body;


        public function __construct()
        {
            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->location = new Location();
            $this->headers = new Headers();
            $this->body = $this->getBody();
        }

        private function getBody(): array
        {
            if ( $this->method === 'GET' ) {
                return [];
            }

            $body_str = file_get_contents(
                'php://input',
                false,
                stream_context_get_default(),
                0,
                $_SERVER['CONTENT_LENGTH']
            );

            if ( !$body_str ) {
                return [];
            }

            return json_decode($body_str, true);
        }
    }
}