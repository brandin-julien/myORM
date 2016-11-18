<?php

require_once "./orm/class/log.php";

class ORM extends log
{
    protected $pdo;

    public function __construct(array $config)
    {
        if (!array_key_exists("host", $config) && !array_key_exists("user", $config) && !array_key_exists("password", $config)) {
            throw new Exception('Error of parameters');
        }
        $this->pdo = new PDO($config['host'], $config['user'], $config['password']);
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

        if ($error[0] != 0) {
            $this->errorLog($stmt->queryString, $error);
            return false;
        } else {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            $finRequestTime = microtime(true);
            $requestTime = $finRequestTime - $debutRequestTime;
            $this->saveLog($stmt->queryString, $requestTime);

            return $result;
        }
    }

    public function select($table, $fields = "*", $where = "", $order = "", $limit = "")
    {
        $query = "SELECT " . $fields . " FROM " . $table;

        if ($where)
            $query .= " WHERE " . $where;
        if ($order)
            $query .= " ORDER BY " . $order;
        if ($limit)
            $query .= " LIMIT " . $limit;

        $result = $this->execQuery($query);
        return $result;
    }

    public function insert($table, $fields, $values)
    {
        $query = "INSERT INTO " . $table . "(" . $fields . ")" . " VALUES (" . $values . ")";

        $result = $this->execQuery($query);
        return $result;
    }

    public function update($table, $fields, $values, $where = "")
    {
        $param = array();

        if (sizeof($fields) != sizeof($values)) {
            throw new Exception("Missing fields or values");
        }

        for ($i = 0; $i < sizeof($fields); $i++) {
            $param[] = $fields[$i] . "= '" . $values[$i] . "'";
        }
        $param = implode(",", $param);
        $query = "UPDATE " . $table . " SET " . $param;

        if ($where)
            $query .= " WHERE " . $where;

        $result = $this->execQuery($query);
        return $result;
    }

    public function remove($table, $where = "")
    {
        $query = "DELETE FROM " . $table . " WHERE " . $where;
        $result = $this->execQuery($query);
        return $result;
    }

    public function find($table, $id)
    {
        $query = "SELECT * FROM " . $table . " WHERE id=" . $id;

        $result = $this->execQuery($query);
        return $result;
    }

    public function findAll($table)
    {
        $query = "SELECT * FROM " . $table;

        $result = $this->execQuery($query);
        return $result;
    }

    function findBy($table, $field, $value)
    {
        $query = "SELECT * FROM " . $table . " WHERE " . $field . "='" . $value . "'";

        $result = $this->execQuery($query);
        return $result;
    }

    function findOneBy($table, $field, $value)
    {

        $query = "SELECT * FROM " . $table . " WHERE " . $field . "='" . $value . "' LIMIT 1";

        $result = $this->execQuery($query);

        if (!empty($result))
            return $result[0];
        return null;
    }

    public function count($table, $row = "*", $where = "")
    {
        $query = "SELECT COUNT(". $row .") FROM " . $table;

        if ($where)
            $query .= " WHERE " . $where;

        $result = $this->execQuery($query);

        if($result){
            $array = get_object_vars($result[0]);
            return intval($array['COUNT(*)']);
        }
        return 0;
    }

    public function check($table, $row, $where = "")
    {
        $query = "SELECT ". $row ." FROM " . $table . " WHERE " . $where;

        $result = $this->execQuery($query);

        return !empty($result);
    }
}