<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id !== false && $id !== null) {
    $statement = $pdo->prepare('SELECT * FROM videos WHERE id = ?;');
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $video = $statement->fetch(PDO::FETCH_ASSOC);
}

?>
<?php require_once 'inicio-html.php'; ?>

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

<?php require_once 'fim-html.php'; ?>