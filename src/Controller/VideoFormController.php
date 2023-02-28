<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VideoFormController extends ControllerHTML
{
    public function __construct(
        private VideoRepository $videoRepository,
        private Engine $template
    ){}
    

    public function handle(ServerRequestInterface $req): ResponseInterface
    {
        $params = $req->getQueryParams();
        $id = filter_var($params['id'] ?? '', FILTER_VALIDATE_INT);

        $video = null;

        if ($id !== false && $id !== null) {
            $video = $this->videoRepository->find($id);
            
        }

        return new Response(200, body: $this->template->render('form-video', ['id' => $id, 'video' => $video]));
    }
}
