<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Repository\VideoRepository;

class VideoListController implements Controller
{
    

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $videoList = $this->videoRepository->all();
        require_once __DIR__ . '/../../views/list-video.php';
    }
}