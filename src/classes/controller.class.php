<?php

namespace SKP_API\Classes;


if ( !class_exists('\SKP_API\Classes\Controller') ) {
    class Controller {
        private string $controller_url = '';
        private array $entities = [];

        private function add_entity(string $url, Callable $callback, string $method): void
        {
            $this->entities[$this->controller_url . $url] = [
                'callback' => $callback,
                'method' => $method
            ];
        }

        public function get_entity(string $url): mixed
        {
            if ( isset($this->entities[$url]) ) {
                return $this->entities[$url];
            }

            return false;
        }

        public function POST(string $url, Callable $callback): void
        {
            $this->add_entity($url, $callback, 'POST');
        }

        public function GET(string $url, Callable $callback): void
        {
            $this->add_entity($url, $callback, 'GET');
        }

        public function set_url (string $controller_url): static
        {
            $this->controller_url = $controller_url;
            return $this;
        }

        public function get_url (): string {
            return $this->controller_url;
        }
    }
}