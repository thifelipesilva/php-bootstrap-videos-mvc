<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Helpers\FlashMessageTrait;
use APP\Sk8play\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RemoveCapaController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function handle(ServerRequestInterface $req): ResponseInterface
    {
        $params = $req->getQueryParams();
        $id = filter_var($params['id'], FILTER_VALIDATE_INT);
        if (is_null($id) || $id === false) {
            $this->addErrorMessage('Id inválido');
            return new Response(302, [
                'Location' => '/'
            ]);
            
        }

        $success = $this->videoRepository->removeImage($id);

        if ($success === false) {
            $this->addErrorMessage('A imagem não foi removida');
            return new Response(302, [
                'Location' => '/'
            ]);
        } else {
            return new Response(302, [
                'Location' => '/'
            ]);
        }
    }
}