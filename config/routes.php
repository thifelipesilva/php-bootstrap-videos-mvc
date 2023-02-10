<?php

use APP\Sk8play\Controller\DeletaVideoController;
use APP\Sk8play\Controller\EditaVideoController;
use APP\Sk8play\Controller\NovoVideoController;
use APP\Sk8play\Controller\VideoFormController;
use APP\Sk8play\Controller\VideoListController;

return [
    'GET|/' => VideoListController::class,
    'GET|/novo-video' => VideoFormController::class,
    'POST|/novo-video' => NovoVideoController::class,
    'GET|/editar-video' => VideoFormController::class,
    'POST|/editar-video' => EditaVideoController::class,
    'GET|/remover-video' => DeletaVideoController::class
];