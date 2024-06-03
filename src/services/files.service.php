<?php

namespace SKP_API\Services;

use SKP_API\Entities\File_Response;
use Symfony\Component\Uid\Uuid;
use SKP_API\Errors\Bad_Request;

if ( !class_exists('\SKP_API\Services\Files_Service') ) {
    class Files_Service {
        public function create(array $file): File_Response
        {
            $info = pathinfo($file['name']);
            $extension = $info['extension'];
            $name = Uuid::v1().".$extension";

            if ( !move_uploaded_file( $file['tmp_name'], PUBLIC_FOLDER . DIRECTORY_SEPARATOR . $name) ) {
                new Bad_Request('File upload failed');
            }

            return (new File_Response())
                    ->set_url($name);
        }
    }
}