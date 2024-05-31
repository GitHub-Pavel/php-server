<?php

namespace SKP_API\Classes;

use SKP_API\Errors\Not_Found;

if ( !class_exists('\SKP_API\Classes\Router') ) {
    class Router {
        private string $url;

        /**
         * @var Controller[] $routes
         */
        private array $routes;

        public function __construct($url = '')
        {
            $this->url = $url;
        }

        public function route($url, Controller $controller): void
        {

            $controller->setUrl($this->url . $url);
            $this->routes[] = $controller;
        }

        public function run(Request $request, Response $response): void
        {
            foreach ( $this->routes as $route ) {
                if ( !str_contains($request->location->pathname, $route->getUrl()) ) {
                    continue;
                }

                $entity = $route->getEntity(str_replace($route->getUrl(), '', $request->location->pathname));

                if ( $entity && $request->method === $entity['method'] ) {
                    call_user_func($entity['callback'], $request, $response);
                    return;
                }
            }

            new Not_Found();
        }
    }
}