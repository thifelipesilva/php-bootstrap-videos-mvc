<?php

namespace APP\Sk8play\Controller;

use APP\Sk8play\Repository\VideoRepository;

class VideoFormController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        /** @var ?Video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->videoRepository->find($id);
        }

        require_once __DIR__ . '/../../views/form-video.php';
    }
}
