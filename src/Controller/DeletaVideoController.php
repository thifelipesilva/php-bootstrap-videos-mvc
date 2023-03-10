<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Repository\VideoRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;
use APP\Sk8play\Helpers\FlashMessageTrait;
use Psr\Http\Server\RequestHandlerInterface;

class DeletaVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $videoRepository)
    {        
    }

    public function handle(ServerRequestInterface $req): ResponseInterface
    {
        //$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);//id no parametro da url antes de aplicar a psr
        $params = $req->getQueryParams();

        $id = filter_var($params['id'], FILTER_VALIDATE_INT);

        if ($id === null || $id === false) {

            $this->addErrorMessage('ID inválido');
            return new Response(302, [
                'Location' => '/'
            ]);
        }    
        $sucess = $this->videoRepository->remove($id);
        if ($sucess === false) {
            $this->addErrorMessage('Erro ao remover video');
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

//named arguments | parâmetros nomeados