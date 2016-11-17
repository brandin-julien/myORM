<?php

require_once "orm.php";
require_once "config/conf.php";

$orm = new ORM($config);

$orm->select("films", "title", "title = 'toto'", "title");
//$orm->insert("films", "title, synopsis", "'j\'aime les chips, et toto', '45'");
$orm->update("films", ["title", "synopsis"], ["toto", "titi"], "id=15");
$find = $orm->find("films", 1);
$findAll = $orm->findAll("films");
$findBy = $orm->findBy("films", "synopsis", "titi");
$findOneBy = $orm->findOneBy("films", "synopsis", "titi");
$count = $orm->count("films", "*", "id=1");

var_dump($find);
var_dump($findAll);
var_dump($findBy);
var_dump($findOneBy);
var_dump($count);


