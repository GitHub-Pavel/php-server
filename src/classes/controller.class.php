<?php

namespace SKP_API\Classes;


if ( !class_exists('\SKP_API\Classes\Controller') ) {
    class Controller {
        private string $controller_url = '';
        private array $entities = [];

        private function addEntity(string $url, Callable $callback, string $method): void
        {
            $this->entities[$this->controller_url . $url] = [
                'callback' => $callback,
                'method' => $method
            ];
        }

        public function getEntity(string $url): mixed
        {
            if ( isset($this->entities[$url]) ) {
                return $this->entities[$url];
            }

            return false;
        }

        public function POST(string $url, Callable $callback): void
        {
            $this->addEntity($url, $callback, 'POST');
        }

        public function GET(string $url, Callable $callback): void
        {
            $this->addEntity($url, $callback, 'GET');
        }

        public function setUrl (string $controller_url): static
        {
            $this->controller_url = $controller_url;
            return $this;
        }

        public function getUrl (): string {
            return $this->controller_url;
        }
    }
}