<?php

require_once "orm.php";
require_once "config/conf.php";

if($argc > 1) {
    if ($argv[1] == "create") {
        echo("create" . PHP_EOL);
        $table = $argv[2];
        $fields = $argv[3];
        $values = $argv[4];

        $orm = new ORM($config);

        $result = $orm->insert($table, $fields, $values);

        if(!$result)
            echo("Row created");
        else
            echo("error, please show your log");

    } elseif ($argv[1] == "delete") {
        echo("delete" . PHP_EOL);
        $table = $argv[2];
        $where = $argv[3];

        $orm = new ORM($config);
        $result = $orm->remove($table, $where);

        if(!$result)
            echo("Row updated");
        else
            echo("error, please show your log");

    } elseif ($argv[1] == "update") {
        echo("update" . PHP_EOL);
        $table = $argv[2];
        $fields = $argv[3];
        $values = $argv[4];
        $where = $argv[5];

        $orm = new ORM($config);

        $result = $orm->update($table, $fields, $values, $where); // rajouter un where ou id

        if(!$result)
            echo("Row deleted");
        else
            echo("error, please show your log");

    }
}else{
    $helpFile = fopen("help.txt", "r") or die("Unable to open file!");
    echo fread($helpFile,filesize("help.txt"));
    fclose($helpFile);
}