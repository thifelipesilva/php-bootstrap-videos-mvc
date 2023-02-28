<?php $this->layout('layout');?>

<main class="px-3">
    <form enctype="multipart/form-data" method="post">

        <?php if (isset($_SESSION['error_message'])): ?>
            <h2>
                <?= $_SESSION['error_message']; ?>
                <?php unset($_SESSION['error_message']); ?>
            </h2>
        <?php endif; ?>
        
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

        <div class="form-group py-2">
            <label class="control-label" for="image_path">Imagem do vídeo</label>
            <input
             accept="image/*"
             name="image_path" 
             id="image_path"
             type="file" 
             class="form-control"
            />
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-2">Enviar</button>

    </form>

</main>

