<?php

namespace SKP_API;

use OpenApi\Attributes as OA;

use SKP_API\Classes\Router;
use SKP_API\Classes\Request;
use SKP_API\Classes\Response;
use SKP_API\Controllers\Files_Controller;


if ( !class_exists('\SKP_API\Server') ) {
    #[OA\Info(
        version: '1.0',
        title: 'Skp API'
    )]
    #[OA\OpenApi(
        security: [['ApiKeyAuth' => []]]
    )]
    #[OA\Components(securitySchemes: [
        new OA\SecurityScheme(
            securityScheme: 'ApiKeyAuth',
            type: 'apiKey',
            name: 'X-Api-Key',
            in: 'header'
        )
    ])]
    #[OA\Server(url: '/api/v1')]
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