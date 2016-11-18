myORM
=====

Information:
------------

* Compatibilité mySQL
* Terminal de commaande afin d'aider l'utilisateur (php orm/console/console.php)
* Une gestion des logs est possibles(penser a avoir un dossier log à la racine du projet)
* La base de donnée peut être crée via une commande, mais les tables doivent être faite manuellement
* Possibilité de supprimé toute la base de donnée

Installation:
-------------

* Placer le dossier orm à la ressource de votre projet
* Configurer les informations de la base de donnée dans config/conf.php

Utilisation:
------------

* A mettre au début du votre fichier:
    require_once "./orm/class/orm.php";
    require_once "config/conf.php";
* Instancier la class avec $myVar = new ORM($config);
* Appeler les différentes méthodes afin d'utiliser l'ORM

Liste des fonctions:
--------------------

* public function execQuery($query)
    -> Permet d'éxécuter une requette mySQL
* public function select($table, $fields = "*", $where = "", $order = "", $limit = "")
    -> Permet de selectionner ce que l'on souhaite
* public function insert($table, $fields, $values)
    -> Permet l'nsertion de donnée
* public function update($table, $fields, $values, $where = "")
    -> Modification d'une donnée
* public function remove($table, $where = "")
    -> Supprétion d'une donnée
* public function find($table, $id)
    -> Permet de récupéré suivant un id
* public function findAll($table)
    -> Permet de tout récupéré
* public function findBy($table, $field, $value)
    -> Permet de séléctionné des éléments selon le type souhaité
* public function findOneBy($table, $field, $value)
    -> Permet de séléctionné un seul élément selon le type souhaité
* public function count($table, $row = "*", $where = "")
    -> Comptage sans sélection d'après une requête donnée
* public function check($table, $row, $where = "")
    -> Permet de vérifier l'existence d'une donnée
