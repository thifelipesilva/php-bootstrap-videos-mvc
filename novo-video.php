<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");


$url = filter_input(INPUT_POST, 'linkVideo', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /?sucesso=0');
    exit(); 
}

$titulo = filter_input(INPUT_POST, 'title');
if ($titulo === false) {
    header('Location: /?sucesso=0');
    exit(); 
}

$sql = 'INSERT INTO videos (linkVideo, title) VALUES (?, ?)';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $url);
$statement->bindValue(2, $titulo);
$statement->execute();

header('Location: /?sucesso=1');

