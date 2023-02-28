<?php
namespace APP\Sk8play\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginFormController extends ControllerHTML
{
    public function __construct(private Engine $template)
    {
        
    }
    
    public function handle(ServerRequestInterface $req): ResponseInterface
    {
        if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        return new Response(200, body: $this->template->render('login-form'));
    }
}