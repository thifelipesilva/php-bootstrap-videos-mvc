<?php $this->layout('layout');?>


<main>

    <form method="post">
        <?php if (isset($_SESSION['error_message'])): ?>
            <h2>
                <?= $_SESSION['error_message']; ?>
                <?php unset($_SESSION['error_message']); ?>
            </h2>
        <?php endif; ?>
        <h2 class="text-secondary py-2">Efetue login</h2>
        <div class="form-group">
            <label class="control-label" for="email">Email</label>
            <input class="form-control" name="email" type="email" required placeholder="Digite seu Email" id='email' />
        </div>


        <div class="form-group">
            <label class="control-label" for="password">Password</label>
            <input class="form-control" type="password" name="password" required placeholder="Digite sua password" id='password' />
        </div>

        <input class="btn btn-primary btn-block mt-2" type="submit" value="Entrar" />
    </form>

</main>


