<?php

interface ActionInterface
{
    function select($table, $fields = "", $where = "*", $order = "", $limit = null, $offset = null);

    function insert($table, $fields, $values);

    public function update($table, $fields, $values, $where = ""); // add a where

    function delete($table, $conditions);

    function find($table, $id);

    public function findAll($table);

    function findBy($table, $field, $value);

    function findOneBy($table, $field, $value);

}