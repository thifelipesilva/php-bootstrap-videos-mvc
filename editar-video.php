<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); //id no parametro da url

if ($id === false) {
    header('Location: /index.php?sucesso=0');
    exit();
}

$url = filter_input(INPUT_POST, 'linkVideo', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /index.php?sucesso=0');
    exit(); 
}

$titulo = filter_input(INPUT_POST, 'title');
if ($titulo === false) {
    header('Location: /index.php?sucesso=0');
    exit(); 
}

$sql = 'UPDATE videos SET linkVideo = :linkVideo, title = :title WHERE id = :id';
$statement= $pdo->prepare($sql);
$statement->bindValue(':linkVideo', $url);
$statement->bindValue(':title', $titulo);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
header('Location: /index.php?sucesso=1');