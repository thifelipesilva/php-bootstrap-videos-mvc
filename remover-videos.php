<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);//id no parametro da url
if ($id === false) {
    header('Location: /index.php?sucesso=0');
    exit();
}

$sql = 'DELETE FROM videos WHERE id = ?';
$statement= $pdo->prepare($sql);
$statement->bindValue(1, $id);


$statement->execute();
header('Location: /index.php?sucesso=1');