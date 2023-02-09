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
        require_once __DIR__ . '/../../inicio-html.php';
        ?>

        <ul alt="videos">

            <?php foreach ($videoList as $video): ?>   
                    <li>
                        <iframe width="100%" height="72%" src="<?= $video->linkVideo; ?>"
                            title="Video de skate" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div>
                            <h3><?= $video->title; ?></h3>
                            <div>
                                <a href="./editar-video?id=<?= $video->id; ?>">Editar</a>
                                <a href="./remover-videos?id=<?= $video->id; ?>">Excluir</a>
                            </div>
                        </div>
                    </li> 
            <?php endforeach ?>
        </ul>

        <?php require_once __DIR__ . '/../../fim-html.php';
    }
}