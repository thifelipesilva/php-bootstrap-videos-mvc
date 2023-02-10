<?php

require_once __DIR__ . '/inicio-html.php';

/** @var \APP\Sk8play\Entity\Video|null $video */
?>

<main class="px-3">

    <form method="post">
        <h2 class="text-center text-secondary py-2">Envie um vídeo!</h2>

        <div class="form-group  py-2">
            <label class="control-label" for="linkVideo">Link embed</label>
            <input
             value="<?= $video?->linkVideo ?>" 
             name="linkVideo" 
             required 
             placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" 
             id='linkVideo'
             class="form-control"
            />
        </div>


        <div class="form-group py-2">
            <label class="control-label" for="title">Titulo do vídeo</label>
            <input
             value="<?= $video?->title ?>" 
             name="title" 
             required 
             placeholder="Neste campo, dê o nome do vídeo" 
             id="title" 
             class="form-control"
            />
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-2">Enviar</button>

    </form>

</main>

<?php require_once __DIR__ . '/fim-html.php';