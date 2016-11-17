<?php

require_once "orm.php";
require_once "config/conf.php";

$orm = new ORM($config);

var_dump($orm);

$orm->select("films", "title", "title = 'toto'", "title");
//$orm->insert("films", "title, synopsis", "'j\'aime les chips, et toto', '45'");
$orm->update("films", ["title", "synopsis"], ["toto", "titi"]); // rajouter un where ou id
$orm->find("films", 1);
var_dump($orm->findAll("films"));
$orm->findBy("films", "synopsis", "45");
$orm->findOneBy("films", "synopsis", "Mon contenu");