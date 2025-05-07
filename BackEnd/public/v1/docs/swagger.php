<?php

require __DIR__ . '/../../../vendor/autoload.php';

define('LOCALSERVER', 'http://localhost/Almin%20Bajramovic/Project-Introduction-to-Web-Programming/BackEnd');
define('PRODSERVER', 'https://add-production-server-after-deployment/backend/');


if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') {
    define('BASE_URL', LOCALSERVER);
} else {
    define('BASE_URL', PRODSERVER);
}

$openapi = \OpenApi\Generator::scan([
    __DIR__ . '/doc_setup.php',
    __DIR__ . '/../../../routes'
]);


header('Content-Type: application/json');
echo $openapi->toJson();
