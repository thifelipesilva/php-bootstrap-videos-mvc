<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id !== false) {
    $statement = $pdo->prepare('SELECT * FROM videos WHERE id = ?;');
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $video = $statement->fetch(PDO::FETCH_ASSOC);
}

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S-Play</title>
</head>

<body>

    <!-- Cabecalho -->
    <header>

        <nav>
            <h1><a href="/" >Sk8-Play</a></h1>
            <div>
                <a href="/novo-video">Add</a>
                <a href="../pages/login.html">Sair</a>
            </div>
        </nav>

    </header>
    <!-- Formulario -->
    <main>
    
        <form method="post">
            <h2>Envie um vídeo!</h2>
                <div>
                    <label for="linkVideo">Link embed</label>
                    <input
                     value="<?=$video['linkVideo'] ?>"
                     name="linkVideo"
                     required 
                     placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" 
                     id='linkVideo' 
                    />
                </div>


                <div>
                    <label for="title">Titulo do vídeo</label>
                    <input
                     value="<?=$video['title'] ?>"                        
                     name="title" 
                     required 
                     placeholder="Neste campo, dê o nome do vídeo" 
                     id="title"
                    />
                </div>

                <input type="submit" value="Enviar" />
        </form>

    </main>

</body>

</html>