<?php

namespace SKP_API;

if ( !class_exists('\SKP_API\Files_System') ) {
    class Files_System {
        private string $pined;

        public function pin($path): static
        {
            $this->pined = Files_System::getPath($path);
            return $this;
        }

        public function scan(): array
        {
            $files = scandir($this->pined);
            $callback = fn($file) => $this->pined . DIRECTORY_SEPARATOR . $file;

            return array_map($callback, array_slice($files, 2));
        }

        static function getPath($path): string
        {
            return API_DIR . DIRECTORY_SEPARATOR . $path;
        }

        static function include($file): bool
        {
            if ( file_exists( $file ) ) {
                require_once $file;
                return true;
            }

            return false;
        }
    }
}
