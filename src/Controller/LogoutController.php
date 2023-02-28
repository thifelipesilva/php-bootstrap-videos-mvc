<?php

namespace APP\Sk8play\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class LogoutController implements RequestHandlerInterface 
{
    public function handle(ServerRequestInterface $req): ResponseInterface
    {
        session_destroy();
        return new Response(302, [
            'Location' => '/login'
        ]);
    }
}