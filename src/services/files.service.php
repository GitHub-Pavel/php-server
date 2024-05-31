<?php

namespace SKP_API\Services;

use SKP_API\Errors\Bad_Request;
use Symfony\Component\Uid\Uuid;

if ( !class_exists('\SKP_API\Services\Files_Service') ) {
    class Files_Service {
        public function create(array $file): array
        {
            $info = pathinfo($file['name']);
            $extension = $info['extension'];
            $name = Uuid::v4().".$extension";
            $server_url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";

            if ( !move_uploaded_file( $file['tmp_name'], PUBLIC_FOLDER . DIRECTORY_SEPARATOR . $name) ) {
                new Bad_Request('File upload failed');
            }

            return ['url' => $server_url . DIRECTORY_SEPARATOR . $name];
        }
    }
}