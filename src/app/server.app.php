<?php

namespace SKP_API;

use SKP_API\Classes\Router;
use SKP_API\Classes\Request;
use SKP_API\Classes\Response;
use SKP_API\Controllers\Files_Controller;


if ( !class_exists('\SKP_API\Server') ) {
    class Server {
        private Router $router;
        private Files_Controller $files_controller;

        /**
         * @param Callable[] $middlewares
         */
        private array $middlewares = [];

        public function __construct(
            $router = new Router(API_URL),
            $files_controller = new Files_Controller()
        ) {
            $this->files_controller = $files_controller;
            $this->router = $router;
            $this->init();
        }

        private function init(): void
        {
            $this->router->route('/files', $this->files_controller);
        }

        public function use(Callable $middleware): void
        {
            $this->middlewares[] = $middleware;
        }

        public function run(
            $request = new Request(),
            $response = new Response()
        ): void
        {
            foreach ( $this->middlewares as $middleware ) {
                $middleware($request, $response);
            }

            $this->router->run($request, $response);
        }
    }
}