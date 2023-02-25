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

        $video = new Video($url, $titulo);

        //algum arquivo foi encontrado?
        //processa o upload
        //armazena o caminho no meu objeto video

        if ($_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file($_FILES['image_path']['tmp_name'], __DIR__ . '/../../public/img/uploads/' . $_FILES['image_path']['name']);
            $video->setFilePathh($_FILES['image_path']['name']);
        }


        $sucess = $this->videoRepository->add($video);

        if ($sucess === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
        
    }
}