<?php
namespace APP\Sk8play\Controller;

use APP\Sk8play\Controller\Controller;
use PDO;

class LoginController implements Controller {
    
    private PDO $pdo;

    public function __construct()
    {
        $dbPath = __DIR__ . '/../../banco.sqlite';
        $this->pdo = new PDO("sqlite:$dbPath");
    }
    public function processaRequisicao(): void
    {
        //encontra usuario por email
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $sql = 'SELECT * FROM users WHERE email = ?';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(1, $email);
        $stm->execute();

        $userData = $stm->fetch(PDO::FETCH_ASSOC);
        $correctPassword =  password_verify($password, $userData['password'] ?? '');

        if ($correctPassword) {
            $_SESSION['logado'] = true;
            header('Location: /');
        } else {
            header('Location: /login?sucess=0');
        }
        
    }
}