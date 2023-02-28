<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Entity\Video;
use APP\Sk8play\Helpers\FlashMessageTrait;
use APP\Sk8play\Repository\VideoRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class EditaVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function handle(ServerRequestInterface $req): ResponseInterface
    {
        $params = $req->getQueryParams();//funcao da interface ServerRequestInterface, devolve um array com os params da requisicao

        $id = filter_var($params['id'], FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            $this->addErrorMessage('ID inválido');
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $url = filter_var($params['linkVideo'], FILTER_VALIDATE_URL);
        if ($url === false) {
            $this->addErrorMessage('Url Inválida');
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $titulo = filter_var($params['title']);
        if ($titulo === false) {
            $this->addErrorMessage('Titulo Inválido');
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $video = new Video($url, $titulo);
        $video->setId($id);
        

        //movendo arquivo recebido para a pasta de destinho. Se não houver erro com a foto
        if ($_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file(
                $_FILES['image_path']['tmp_name'],
                __DIR__ . '/../../public/img/uploads/' . $_FILES['image_path']['name']
            );
            $video->setFilePathh($_FILES['image_path']['name']);
        }

        $success = $this->videoRepository->update($video);

        if ($success === false) {
            $this->addErrorMessage('Erro ao atualizar');
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
