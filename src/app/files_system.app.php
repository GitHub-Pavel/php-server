<?php

namespace SKP_API;

if ( !class_exists('\SKP_API\Files_System') ) {
    class Files_System {
        private string $pined;

        public function pin($path): static
        {
            $this->pined = self::get_path($path);
            return $this;
        }

        public function scan(): array
        {
            $files = scandir($this->pined);
            return array_slice($files, 2);
        }

        static function get_path(...$args): string
        {
            if ( str_contains($args[0], API_DIR) ) {
                return implode(DIRECTORY_SEPARATOR, $args);
            }

            return API_DIR . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $args);
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
