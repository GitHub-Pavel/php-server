<?php

use SKP_API\Files_System;
use SKP_API\Server;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/main.app.php';

$files_system = new Files_System();
$folders = ["constants", "utils", "middlewares", "classes", "errors", "controllers", "services"];

foreach ( $folders as $folder ) {
    foreach ( $files_system->pin($folder)->scan() as $file ) {
        Files_System::include($file);
    }
}

$app = new Server();

$app->use(set_public());
$app->use(api_secure());

$app->run();



