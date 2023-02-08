<?php
$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$videoList = $pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);

?>
<?php require_once 'inicio-html.php'; ?>

    <!-- videos -->
    <ul alt="videos">

        <?php foreach ($videoList as $video): ?>   
                <li>
                    <iframe width="100%" height="72%" src="<?= $video['linkVideo']; ?>"
                        title="Video de skate" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    <div>
                        
                        <h3><?php echo $video['title']; ?></h3>
                        <div>
                            <a href="./editar-video?id=<?= $video['id']; ?>">Editar</a>
                            <a href="./remover-videos?id=<?= $video['id']; ?>">Excluir</a>
                        </div>
                    </div>
                </li> 
        <?php endforeach ?>
    </ul>
<?php require_once 'fim-html.php'; ?>