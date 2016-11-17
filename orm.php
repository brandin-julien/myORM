<?php

require_once "action.php";
require_once "log.php";

class ORM extends log implements ActionInterface
{
    protected $pdo;

    public function __construct(array $config)
    {
        if (sizeof($config) != 3) {
            throw new Exception('Invalid number of parameters');
        }
        $this->pdo = new PDO($config['host'],$config['user'],$config['password']);
    }

    public function execQuery($query)
    {
        if (!is_string($query) || empty($query)) {
            throw new Exception("Query not valid");
        }

        $debutRequestTime = microtime(true);

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $error = $stmt->errorInfo();

        if($error[0] != 0){
            var_dump($error);
            $this->errorLog($stmt->queryString, $error);
        }else {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            $finRequestTime = microtime(true);
            $requestTime = $finRequestTime - $debutRequestTime;
            $this->saveLog($stmt->queryString, $requestTime);

            return $result;
        }
    }

    public function select($table, $fields = "*", $where = "", $order = "", $limit = null, $offset = null)
    {
        $query = "SELECT " . $fields . " FROM " . $table;

        if($where)
            $query .= " WHERE " . $where;
        if($order)
            $query .= " ORDER BY " . $order;
        if($limit)
            $query .= " LIMIT " . $limit;

        var_dump($query);
        $result = $this->execQuery($query);
        return $result;
    }
    
    public function insert($table, $fields, $values)
    {
        $query = "INSERT INTO " . $table . "(" . $fields . ")" . " VALUES (" . $values . ")";

        var_dump($query);
        $this->execQuery($query);
    }

    public function update($table, $fields, $values, $where = "")
    {
        $param = array();

        if (sizeof($fields) != sizeof($values)){
            throw new Exception("Missing fields or values");
        }

        for($i = 0; $i < sizeof($fields); $i++){
            $param[] = $fields[$i] . "= '" . $values[$i] . "'";
        }
        $param = implode(",", $param);
        $query = "UPDATE " . $table . " SET " . $param;

        if($where)
            $query .= " WHERE " . $where;

        var_dump($query);
        $this->execQuery($query);
    }
    
    public function delete($table, $where = "")
    {
        //TO SOMETHING
    }
    
    public function find($table, $id){
        $query = "SELECT * FROM " . $table . " WHERE id=" .$id;

        var_dump($query);
        $result = $this->execQuery($query);
        return $result;
    }

    public function findAll($table){
        $query = "SELECT * FROM " . $table;

        var_dump($query);
        $result = $this->execQuery($query);
        return $result;
    }


    function findBy($table, $field, $value){
        $query = "SELECT * FROM " . $table . " WHERE ". $field ."='". $value ."'";

        var_dump($query);
        $result = $this->execQuery($query);
        return $result;
    }

    function findOneBy($table, $field, $value){

        $query = "SELECT * FROM " . $table . " WHERE ". $field ."='". $value ."' LIMIT 1";

        var_dump($query);
        $result = $this->execQuery($query);

        if(!empty($result))
            return $result[0];
        return null;
    }
}