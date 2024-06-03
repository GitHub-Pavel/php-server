<?php

if ( !defined('SERVER_URL') ) {
    define('SERVER_URL', (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]");
}