<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Entity\Video;
use APP\Sk8play\Repository\VideoRepository;

class EditaVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: /?sucesso=0');
            return;
        }

        $url = filter_input(INPUT_POST, 'linkVideo', FILTER_VALIDATE_URL);
        if ($url === false) {
            header('Location: /?sucesso=0');
            return;
        }
        $titulo = filter_input(INPUT_POST, 'title');
        if ($titulo === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $video = new Video($url, $titulo);
        $video->setId($id);
        

        if ($_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file(
                $_FILES['image_path']['tmp_name'],
                __DIR__ . '/../../public/img/uploads/' . $_FILES['image_path']['name']
            );
            $video->setFilePathh($_FILES['image_path']['name']);
        }

        $success = $this->videoRepository->update($video);

        if ($success === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}
