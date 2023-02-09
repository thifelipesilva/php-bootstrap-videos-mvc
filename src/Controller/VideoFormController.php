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

        require_once __DIR__ . '/../../inicio-html.php';
?>
        <main>

            <form method="post">
                <h2>Envie um vídeo!</h2>

                <div>
                    <label for="linkVideo">Link embed</label>
                    <input value="<?= $video?->linkVideo ?>" name="linkVideo" required placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='linkVideo' />
                </div>


                <div>
                    <label for="title">Titulo do vídeo</label>
                    <input value="<?= $video?->title ?>" name="title" required placeholder="Neste campo, dê o nome do vídeo" id="title" />
                </div>

                <input type="submit" value="Enviar" />

            </form>

        </main>

<?php require_once 'fim-html.php';
    }
}
