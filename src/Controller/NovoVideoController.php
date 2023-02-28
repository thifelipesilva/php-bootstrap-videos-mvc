<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Entity\Video;
use APP\Sk8play\Repository\VideoRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use APP\Sk8play\Helpers\FlashMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class NovoVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {        
    }

    public function handle(ServerRequestInterface $req): ResponseInterface
    {
        $params = $req->getParsedBody();
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
        $files = $req->getUploadedFiles();
        $uploadImage = $files['image_path'];
        //algum arquivo foi encontrado?
        //verifica se o arquivo tem  a extensao de uma imagem
        //processa o upload
        //armazena o caminho no meu objeto video

        if ($uploadImage->getError() === UPLOAD_ERR_OK) {            
            //verificando se esse arquivo é uma imagem pelos primeiros bytes do arquivo
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $tmpFile = $uploadImage->getStream()->getMetadata('uri');
            $mimeType = $finfo->file($tmpFile);

            //verificando se é uma imgame
            if (str_starts_with($mimeType, 'image/')) {
                $safeFileName = uniqid('upload_') . '_' . pathinfo($uploadImage->getClientFilename(), PATHINFO_BASENAME); //tratanto nome do arquivo, deixando ele mais seguro
                $uploadImage->moveTo(__DIR__ . '/../../public/img/uploads/' . $safeFileName);//movendo o arquivo recebido pra pasta de uploads
                $video->setFilePathh($safeFileName);
            }
        }


        $sucess = $this->videoRepository->add($video);

        if ($sucess === false) {
            $this->addErrorMessage('Erro ao cadastrar video');
            return new Response(302, [
                'Location' => '/'
            ]);
        }
        
        return new Response(302,  [
            'Location' => '/'
        ]);
        
    }
}