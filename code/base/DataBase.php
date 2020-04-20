<?php

namespace base;

use config\ConfigDataBase as config;

class DataBase
{

    private static $instance;
    private static $link = null;

    /**
     * @return \mysqli|null
     */
    public static function getInstance()
    {
        if (self::$link === null) {

            self::$link = new \mysqli(config::HOST, config::USER, config::PASSWORD);

            if (!empty(self::$link->connect_error)) {
                die(self::$link->connect_error);
            }

            if (!self::$link->select_db(config::DB)) {
                die(self::$link->error);
            }
            self::$link->query('SET NAMES utf8');
        }

        return self::$link;
    }

    /**
     * @param $value
     * @return string
     */
    public function clean($value)
    {
        return strip_tags(trim($value));
    }

    /**
     * @param $value
     * @return string
     */
    public function escape($value)
    {
        return self::getInstance()->real_escape_string($value);
    }

    /**
     * @param $params
     * @return array
     */
    private static function handler($params)
    {
        $array = [];

        foreach ($params as $param) {

            if (gettype($param) == 'string' && $param != 'NULL') {
                $param = '"' . $param . '"';
            }
            $array[] = $param;
        }

        return $array;
    }

    /**
     * @param $table
     * @param null $params
     * @param null $condition
     * @param null $orderAndGroup
     * @param null $sort
     * @param null $limit
     * @return array
     */
    public function show($table, $params = null, $condition = null, $orderAndGroup = null, $sort = null, $limit = null)
    {
        if ($params == null) {
            $params = '*';
        } else {
            $params = implode(', ', $params);
        }

        $where = '';

        if ($condition != null) {
            if (count($condition) > 1) {
                foreach ($condition as $key => $value) {
                    $where .= $key . ' = "' . $value . '" AND ';
                }
                $where = substr($where, 0, -5);
            } else {
                $where = key($condition) . ' = ' . '"' . $condition[key($condition)] . '"';
            }

            $where = ' WHERE ' . $where;
        }

        $limit = $limit != null ? ' LIMIT ' . $limit : '';

        if ($orderAndGroup != null) {
            $by = $orderAndGroup[0] == 'order' ? ' ORDER BY ' . $orderAndGroup[1] : '';
        }

        $sort = $sort != null ? ' ' . strtoupper($sort) . ' ' : '';

        $string = 'SELECT ' . $params . ' FROM ' . $table . $where . $by . $sort . $limit;
        $query = self::getInstance()->query($string);
        $array = [];

        while ($row = $query->fetch_assoc()) {
            $array[] = $row;
        }

        return $array;
    }

    /**
     * @param $params
     * @param $to
     * @return bool|\mysqli_result
     */
    public function add($params, $to)
    {
        $array = self::handler($params);
        $string = 'INSERT INTO ' . $to . ' VALUES(' . implode(', ', $array) . ')';

        return self::getInstance()->query($string);
    }

}