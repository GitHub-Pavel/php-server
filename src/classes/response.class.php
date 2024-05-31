<?php

namespace SKP_API\Classes;

use JetBrains\PhpStorm\NoReturn;
use SKP_API\Errors\Not_Found;
use SKP_API\Files_System;

if ( !class_exists('SKP_API\Classes\Response') ) {
    class Response {
        #[NoReturn]
        public function json(array $json): void
        {
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(200);
            echo json_encode($json);
            die(200);
        }

        #[NoReturn]
        public function success(): void
        {
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(200);
            die(200);
        }

        #[NoReturn]
        public function file(string $file_path): void
        {
            $file_path = Files_System::getPath(PUBLIC_FOLDER . DIRECTORY_SEPARATOR . $file_path);

            if ( !file_exists( $file_path ) ) {
                new Not_Found("File not found");
            }

            $file = file_get_contents($file_path);
            $mime = mime_content_type($file_path);
            $length = strlen($file);

            header("Content-Length: $length");
            header("Content-type: $mime;");
            http_response_code(200);
            echo $file;
            die(200);
        }
    }
}