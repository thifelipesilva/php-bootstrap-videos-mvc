<?php
//implementacao da psr 11 - dependencies container
use DI\ContainerBuilder;
use League\Plates\Engine;

$builder = new ContainerBuilder();
//$dbPath = __DIR__ . '/../banco.sqlite';
$builder->addDefinitions([
  // objects dependencies  
  //PDO::class => \DI\create(PDO::class)->constructor($dbPath),
    
  //factory dependencies
  PDO::class => function ():PDO {
    $dbPath = __DIR__ . '/../banco.sqlite';
    return new PDO("sqlite:$dbPath");
  },
  //template engine 
  Engine::class => function (): Engine {
    $templatePath = __DIR__ . '/../views';
    return new Engine($templatePath);
  }      

    
]);

$container = $builder->build();

return $container;