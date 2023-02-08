<?php



$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");



$videoList = $pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);




?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK8-Play</title>
</head>

<body>
    <!-- Cabecalho -->
    <header>

        <nav>
            <h1><a href="/" >Sk8-Play</a></h1>

            <div>
                <a href="./novo-video" >Add</a>
                <a href="./pages/login.html">Sair</a>
            </div>
        </nav>

    </header>
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
</body>

</html>