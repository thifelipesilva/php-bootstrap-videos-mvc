<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Repository\VideoRepository;

class DeletaVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {        
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);//id no parametro da url
        if ($id === null || $id === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $sucess = $this->videoRepository->remove($id);
        if ($sucess === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}