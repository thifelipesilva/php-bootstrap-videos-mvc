<?php
namespace APP\Sk8play\Controller;

class LoginFormController implements Controller {
    
    public function processaRequisicao(): void
    {
        if ($_SESSION['logado'] === true) {
            header ('Location: /');
            return;
        }
        require_once __DIR__ . '/../../views/login-form.php';
    }
}