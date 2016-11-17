<?php

if($argc > 1) {
    if ($argv[1] == "create") {
        echo("create" . PHP_EOL);
        $table = $argv[2];
        echo($table . PHP_EOL);
        $fields = $argv[3];
        echo($fields . PHP_EOL);
        $values = $argv[4];
        echo($values . PHP_EOL);
    } elseif ($argv[1] == "delete") {
        echo("delete" . PHP_EOL);
        $table = $argv[2];
        echo($table . PHP_EOL);
        $where = $argv[3];
        echo($where . PHP_EOL);
    } elseif ($argv[1] == "update") {
        echo("update" . PHP_EOL);
        $table = $argv[2];
        echo($table . PHP_EOL);
        $fields = $argv[3];
        echo($fields . PHP_EOL);
        $values = $argv[4];
        echo($values . PHP_EOL);
    }
}else{
    $helpFile = fopen("help.txt", "r") or die("Unable to open file!");
    echo fread($helpFile,filesize("help.txt"));
    fclose($helpFile);
}