<?php

namespace APP\Sk8play\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Error404Controller implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $req): ResponseInterface
    {        
        return new Response(404);
    }
}