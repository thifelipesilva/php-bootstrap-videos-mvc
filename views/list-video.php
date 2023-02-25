<?php
require_once __DIR__ . '/inicio-html.php';
?>

<div class="px-3">
    <ul alt="videos" class="card-group list-unstyled gap-3">
        <?php foreach ($videoList as $video) : ?>
            <li>
                <div class="card border-dark">
                    
                    <?php if ($video->getFilePath() !== null): ?>
                        <a href="<?= $video->linkVideo; ?>">
                            <img src="/img/uploads/<?= $video->getFilePath(); ?>" alt="">
                        </a>
                    <?php else: ?>
                        <iframe 
                         width="100%" 
                         height="72%" 
                         src="<?= $video->linkVideo; ?>" 
                         title="Video de skate" 
                         frameborder="0" 
                         allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                         allowfullscreen
                        >
                        </iframe>
                    <?php endif; ?>
                    <div class="card-body">
                        <h3 class="card-title h4"><?= $video->title; ?></h3>
                        <div>
                            <a href="./editar-video?id=<?= $video->id; ?>" class="btn btn-primary">Editar</a>
                            <a href="./remover-video?id=<?= $video->id; ?>" class="btn btn-danger">Excluir</a>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</div>

<?php require_once __DIR__ . '/fim-html.php';
