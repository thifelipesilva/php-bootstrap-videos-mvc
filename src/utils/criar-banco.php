<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$pdo->exec('CREATE TABLE videos (id INTEGER PRIMARY KEY, linkVideo TEXT, title TEXT);');
$pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, email TEXT, password TEXT);');