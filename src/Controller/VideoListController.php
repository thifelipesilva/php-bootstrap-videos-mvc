<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VideoListController extends ControllerHTML
{
    

    public function __construct(
        private VideoRepository $videoRepository,
        private Engine $template
    )
    {
    }

    public function handle(ServerRequestInterface $req): ResponseInterface
    {   
        $videoList = $this->videoRepository->all();
        return new Response(200, body: $this->template->render('list-video', ['videoList' => $videoList])); 
    }
}