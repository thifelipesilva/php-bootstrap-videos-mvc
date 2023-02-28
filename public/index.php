<?php

use APP\Sk8play\Controller\Error404Controller;
use Nyholm\Psr7\Factory\Psr17Factory;

require_once __DIR__ . '/../vendor/autoload.php';


$routes = require_once __DIR__ . '/../config/routes.php';

//container de injecao de dependencias psr-11
$diContainer = require_once __DIR__ . '/../config/dependencies.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

//autorização de login 
session_start();//verifica se uma sessao foi criada, se nao cria uma sessao
session_regenerate_id();//cria um novo id para a sessao a cara requisicao
$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
    header('Location: /login');
    return;
}


$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routes)) {
    $controllerClass = $routes[$key];
    $controller = $diContainer->get($controllerClass);
} else {
    $controller = new Error404Controller();
}

$psr17Factory = new Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$response = $controller->handle($request);

http_response_code($response->getStatusCode());

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {  
        header (sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
