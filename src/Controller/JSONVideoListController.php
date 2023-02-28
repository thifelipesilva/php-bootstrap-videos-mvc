<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Entity\Video;
use APP\Sk8play\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class JSONVideoListController implements RequestHandlerInterface
{
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }
    public function handle(ServerRequestInterface $req): ResponseInterface
    {
        $videoList = array_map(function (Video $video): array
        {
            return [
                'url' => $video->linkVideo,
                'title' => $video->title,
                'file_path' => '/img/uploads/' . $video->getFilePath()
            ];
            
        }, $this->videoRepository->all());

        return new Response(200, [
            'Content-Type' => 'application/json'
        ], json_encode($videoList));
    }
}