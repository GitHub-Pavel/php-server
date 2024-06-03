<?php

namespace SKP_API\Entities;

use OpenApi\Attributes as OA;

if ( !class_exists('\SKP_API\Entities\File_Response') ) {
    #[OA\Schema(type: "object")]
    class File_Response {
        #[OA\Property(property: "url", description: "Url to image", type: "string")]
        public string $url;

        public function set_url(string $file_name): File_Response
        {
            $this->url = SERVER_URL . DIRECTORY_SEPARATOR . $file_name;
            return $this;
        }
    }
}

if ( !class_exists('\SKP_API\Entities\File_Request') ) {
    #[OA\Schema(type: "object")]
    class File_Request {
        #[OA\Property(property: "file", type: "file")]
        public array $file;
    }
}