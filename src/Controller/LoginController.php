<?php
namespace APP\Sk8play\Controller;


use APP\Sk8play\Helpers\FlashMessageTrait;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class LoginController implements RequestHandlerInterface 
{
    use FlashMessageTrait;
    private PDO $pdo;

    public function __construct()
    {
        $dbPath = __DIR__ . '/../../banco.sqlite';
        $this->pdo = new PDO("sqlite:$dbPath");
    }
    public function handle(ServerRequestInterface $req): ResponseInterface
    {
        
        //encontra usuario por email
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        //refatorar
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(1, $email);
        $stm->execute();

        $userData = $stm->fetch(PDO::FETCH_ASSOC);
        $correctPassword =  password_verify($password, $userData['password'] ?? '');

        if (!$correctPassword) {
            $this->addErrorMessage('Usuário ou senhas Inválido');
            return new Response(302, [
                'Location' => '/login'
            ]);
        }

        if (password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
            $statement = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
            $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
            $statement->bindValue(2, $userData['id']);
            $statement->execute();
        }
        
    
        $_SESSION['logado'] = true;

        return new Response(302, ['Location' => '/']);
    
    }
}