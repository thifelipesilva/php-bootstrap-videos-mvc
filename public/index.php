<?php

use APP\Sk8play\Controller\DeletaVideoController;
use APP\Sk8play\Controller\EditaVideoController;
use APP\Sk8play\Controller\Error404Controller;
use APP\Sk8play\Controller\NovoVideoController;
use APP\Sk8play\Controller\VideoFormController;
use APP\Sk8play\Controller\VideoListController;
use APP\Sk8play\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
    $controller = new VideoListController($videoRepository);
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($videoRepository);

    } elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new NovoVideoController($videoRepository);

    }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($videoRepository);

    } elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new EditaVideoController($videoRepository);

    }
} elseif ($_SERVER['PATH_INFO'] === '/remover-videos') {
    $controller = new DeletaVideoController($videoRepository);
} else {
    $controller = new Error404Controller();
}

/** @var APP\Sk8play\Controller $controller*/
$controller->processaRequisicao();