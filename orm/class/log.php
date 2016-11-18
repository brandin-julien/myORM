<?php

Class log
{
    public function saveLog($query, $requestTime){
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');
        $filePath =  "./log/request.log";
        $fp = fopen($filePath, "a+");
        fputs($fp, "DATE => [" . $dateString . "] " . "REQUEST => \"" . $query . "\" EXECUTION_TIME =>" . $requestTime . " ms" . PHP_EOL);
        fclose($fp);
    }

    public function errorLog($query, $data){
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');
        $filePath =  "./log/request.log";
        $fp = fopen($filePath, "a+");
        fputs($fp, "DATE => [" . $dateString . "] " . "REQUEST => \"" . $query . "\"". " DRIVER_CODE => " . $data[0] ." ERROR_CODE => " . $data[1] ."ERROR_MESSAGE => " . $data[2] . PHP_EOL);
        fclose($fp);
    }
}
