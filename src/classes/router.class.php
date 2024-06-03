<?php

namespace SKP_API\Classes;

use SKP_API\Errors\Not_Found;
use OpenApi\Attributes as OA;

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

            $controller->set_url($this->url . $url);
            $this->routes[] = $controller;
        }

        public function run(Request $request, Response $response): void
        {
            foreach ( $this->routes as $route ) {
                if ( !str_contains($request->location->pathname, $route->get_url()) ) {
                    continue;
                }

                $entity = $route->get_entity(str_replace($route->get_url(), '', $request->location->pathname));

                if ( $entity && $request->method === $entity['method'] ) {
                    call_user_func($entity['callback'], $request, $response);
                    return;
                }
            }

            new Not_Found();
        }
    }
}