<?php

require_once __DIR__ . '/inicio-html.php';
?>


<main>

    <form method="post">
        <h2>Efetue login</h2>
            <div>
                <label for="email">Email</label>
                <input name="email" type="email" required placeholder="Digite seu Email" id='email' />
            </div>


            <div>
                <label for="password">Password</label>
                <input type="password" name="password" required placeholder="Digite sua password" id='password' />
            </div>

            <input type="submit" value="Entrar" />
    </form>

</main>

<?php require_once __DIR__ . '/fim-html.php';