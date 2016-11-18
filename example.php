<?php

require_once "./orm/class/orm.php";
require_once "config/conf.php";

$orm = new ORM($config);

$orm->select("films", "title", "title = 'toto'", "title");

$orm->insert("films", "title, synopsis", "'Marius', 'César astique son comptoir et sert de généreux pastis aux habitués de son café, le bar de la Marine, installé sur le Vieux-Port de Marseille...'");

$title = "matrix";
$synopsis = "Un film";

$values = "'" . $title . "' , '" . $synopsis . "'";

$orm->insert("films", "title, synopsis", $values);

$orm->update("films", ["title", "synopsis"], ["Matrix", "Un bon film"], "title='matrix'");

$find = $orm->find("films", 1);

$findAll = $orm->findAll("films");

$findBy = $orm->findBy("films", "title", "Matrix");

$findOneBy = $orm->findOneBy("films", "synopsis", "un certain films");

$count = $orm->count("films", "*", "title like '%Ma%'");

$check = $orm->check("films", "*", "id=1");

echo("find" . PHP_EOL);
var_dump($find);

echo("findAll" . PHP_EOL);
var_dump($findAll);

echo("findBy" . PHP_EOL);
var_dump($findBy);

echo("findOneBy" . PHP_EOL);
var_dump($findOneBy);

echo("count" . PHP_EOL);
var_dump($count);

echo("check" . PHP_EOL);
var_dump($check);
