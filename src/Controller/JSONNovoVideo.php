<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Entity\Video;
use APP\Sk8play\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class JSONNovoVideo implements RequestHandlerInterface
{
    public function __construct(private VideoRepository $videoRepository)
    {    
    }

    public function handle(ServerRequestInterface $req): ResponseInterface
    {

        $req = $req->getBody()->getContents(); //conteudo da requisicao
        $videoData = json_decode($req, true); //funcao formatara os dados e retornara o um array associativo (true). getBodyParser()

        $video = new Video($videoData['linkVideo'], $videoData['title']);
        $this->videoRepository->add($video);

        return new Response(201);
    }
}