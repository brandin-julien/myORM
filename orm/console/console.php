<?php

require_once "./orm/class/orm.php";
require_once "./config/conf.php";

if ($argc > 1) {
    if ($argv[1] == "create") {

        if($argc != 5){
            echo("Error of syntax, create \$table \$fields \$values");
            return -1;
        }

        $table = $argv[2];
        $fields = $argv[3];
        $values = $argv[4];

        $orm = new ORM($config);

        $result = $orm->insert($table, $fields, $values);

        if (!$result)
            echo("Row created");
        else
            echo("error, please show your log");

    } elseif ($argv[1] == "delete") {

        if($argc != 4){
            echo("Error of syntax, delete \$table \$where");
            return -1;
        }

        $table = $argv[2];
        $where = $argv[3];

        $orm = new ORM($config);
        $result = $orm->remove($table, $where);

        if (!$result)
            echo("Row deleted");
        else
            echo("error, please show your log");

    } elseif ($argv[1] == "update") {

        if($argc != 6){
            echo("Error of syntax, update \$table \$fields \$values \$where");
            return -1;
        }

        $table = $argv[2];
        $fields = $argv[3];
        $values = $argv[4];
        $where = $argv[5];

        $orm = new ORM($config);

        $result = $orm->update($table, $fields, $values, $where);

        if (!$result)
            echo("Row updated");
        else
            echo("error, please show your log");
    } elseif ($argv[1] == "database:create") {

        $hostConfig = explode(";", $config['host']);

        if(sizeof($hostConfig) < 1){
            echo("Error, missing host config");
            return -1;
        }

        $newConfig = [
            "host" => $hostConfig[0],
            "user" => "root",
            "password" => "",
        ];

        $dbName = explode("=", $hostConfig[1])[1];

        $orm = new ORM($newConfig);

        $query = "CREATE DATABASE " . $dbName . " CHARACTER SET 'latin1'";

        $result = $orm->execQuery($query);

        if (!$result)
            echo("Database created");
        else
            echo("error, please show your log");
    }
    elseif ($argv[1] == "database:drop") {

        $hostConfig = explode(";", $config['host']);

        if(sizeof($hostConfig) < 1){
            echo("Error, missing host config");
            return -1;
        }

        $newConfig = [
            "host" => $hostConfig[0],
            "user" => "root",
            "password" => "",
        ];

        $dbName = explode("=", $hostConfig[1])[1];

        $orm = new ORM($newConfig);

        $orm = new ORM($config);

        $query = "DROP DATABASE " . $dbName;

        $result = $orm->execQuery($query);

        if (!$result)
            echo("Database dropped");
        else
            echo("error, please show your log");
    }else{
        echo("Error, show command list if you want more help");
    }
} else {
    $helpFile = fopen("./orm/console/help.txt", "r") or die("Unable to open file!");
    echo fread($helpFile, filesize("./orm/console/help.txt"));
    fclose($helpFile);
}