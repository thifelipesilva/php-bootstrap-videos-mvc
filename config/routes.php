<?php

use APP\Sk8play\Controller\DeletaVideoController;
use APP\Sk8play\Controller\EditaVideoController;
use APP\Sk8play\Controller\JSONNovoVideo;
use APP\Sk8play\Controller\JSONVideoListController;
use APP\Sk8play\Controller\LoginFormController;
use APP\Sk8play\Controller\NovoVideoController;
use APP\Sk8play\Controller\VideoFormController;
use APP\Sk8play\Controller\VideoListController;
use APP\Sk8play\Controller\LoginController;
use APP\Sk8play\Controller\LogoutController;
use APP\Sk8play\Controller\RemoveCapaController;

return [
    'GET|/' => VideoListController::class,
    'GET|/novo-video' => VideoFormController::class,
    'POST|/novo-video' => NovoVideoController::class,
    'GET|/editar-video' => VideoFormController::class,
    'POST|/editar-video' => EditaVideoController::class,
    'GET|/remover-video' => DeletaVideoController::class,
    'GET|/login' => LoginFormController::class,
    'POST|/login' => LoginController::class,
    'GET|/logout' => LogoutController::class,
    'GET|/remover-capa' => RemoveCapaController::class,
    'GET|/videos-json' => JSONVideoListController::class,
    'POST|/video' => JSONNovoVideo::class
];