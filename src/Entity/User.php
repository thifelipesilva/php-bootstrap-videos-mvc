<?php


class User {
    public string $email;
    public string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->setPassword($password);
    }

    private function setPassword(string $password): void
    {
        $hash = password_hash($password, PASSWORD_ARGON2ID);
        $this->password = $hash;
    }
}