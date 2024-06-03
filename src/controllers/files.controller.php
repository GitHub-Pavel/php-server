<?php

namespace SKP_API\Controllers;

use JetBrains\PhpStorm\NoReturn;

use SKP_API\Classes\Controller;
use SKP_API\Classes\Response;
use SKP_API\Classes\Request;

use SKP_API\Errors\Bad_Request;
use SKP_API\Errors\Forbidden;

use SKP_API\Services\Files_Service;

use OpenApi\Attributes as OA;

if ( !class_exists('\SKP_API\Controllers\Files_Controller') ) {
    class Files_Controller extends Controller {
        private Files_Service $files_service;

        public function __construct($files_service = new Files_Service())
        {
            $this->files_service = $files_service;
            $this->POST('/create', [$this, 'create']);
        }

        #[NoReturn]
        #[OA\Response(
            response: 200,
            description: 'File uploaded successfully',
            content: new OA\JsonContent(ref: '#/components/schemas/File_Response')
        )]
        #[OA\Response(
            response: 400,
            description: 'Invalid request',
            content: new OA\JsonContent(ref: '#/components/schemas/Error')
        )]
        #[OA\POST(path: '/files/create', tags: ['Files'])]
        #[OA\RequestBody(
            required: true,
            content: new OA\MediaType('multipart/form-data',
                schema: new OA\Schema(ref: '#/components/schemas/File_Request'))
        )]
        public function create(Request $request, Response $response): void
        {
            if ( !is_form_data_headers($request) ) {
                new Bad_Request("Content-Type is not a valid form data");
            }

            if ( !$_FILES['file'] ) {
                new Bad_Request('Missing required "file" parameter');
            }

            $file_response = $this->files_service->create($_FILES['file']);
            $response->json($file_response);
        }
    }
}