<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Entity\Video;
use APP\Sk8play\Repository\VideoRepository;

class NovoVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {        
    }

    public function processarequisicao(): void 
    {
        $url = filter_input(INPUT_POST, 'linkVideo', FILTER_VALIDATE_URL);
        if ($url === false) {
            header('Location: /?sucesso=0');
            exit(); 
        }

        $titulo = filter_input(INPUT_POST, 'title');
        if ($titulo === false) {
            header('Location: /?sucesso=0');
            exit(); 
        }

        $sucess = $this->videoRepository->add(new Video($url, $titulo));

        if ($sucess === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
        
    }
}