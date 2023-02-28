<?php

namespace APP\Sk8play\Repository;

use PDO;
use User;

class UserRepository 
{
    public function __construct(private PDO $pdo)
    {
        
    }

    public function encontraUsuarioPorEmail(string $email): User
    {
        
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(1, $email);
        $stm->execute();

        $userData = $stm->fetch(PDO::FETCH_ASSOC);

        return $userData;
    }
}