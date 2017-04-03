<?php

class Broker extends PDO {

    private $table_prefix = "";
    private $exist = true;
    public $sth = null;
    private $mem = null;
    static $numCalls = 0;
    private $_error="";

   /* public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $TABLE_PREFIX) {
        try {
            parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME . ";charset=utf-8", $DB_USER, $DB_PASS);
        } catch (Exception $e) {
            $this->_error=$e->getTraceAsString();
            $this->exist = false;
        }
        if (!$this->exist) {
            parent::__construct($DB_TYPE . ':host=' . $DB_HOST, $DB_USER, $DB_PASS);
           // return false;
        }
        $this->table_prefix = $TABLE_PREFIX;
        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
    }*/
    
    private function create($dbname) {
        $this->sth = $this->prepare("CREATE `$dbname`");
        $this->sth->execute();
    }

    public function select($query, $data = array(), $fetchMode = PDO::FETCH_ASSOC, $single = false) {
        self::$numCalls++;
        $sql = $this->addPrefix($query);
        $this->sth = $this->prepare($sql);
        if ($data)
            foreach ($data as $key => $value) {
                $this->sth->bindValue($key, $value);
            }
        $this->sth->execute();
        //print_r($this->sth );
        if ($single == true) {
            return $this->sth->fetch($fetchMode);
        } else {
            return $this->sth->fetchAll($fetchMode);
        }
    }

    public function insert($table, $data) {

        $fieldNames = implode("`, `", array_keys($data));
        $fieldValues = implode(", :", array_keys($data));
        $sql = "INSERT INTO " . $table . " (`$fieldNames`) VALUES (:{$fieldValues}) ";

        $this->sth = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $this->sth->bindValue(":" . $key, $value);
        }
        $this->sth->execute();
        return $this->lastInsertId();
    }

    public function update($table, $data, $where) {
        foreach ($data as $key => $value) {
            $set.=" " . $key . "=:$key,";
        }
        $set = rtrim($set, ",");
        $sql = "UPDATE  " . $table . " SET $set WHERE $where ";
        $this->sth = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $this->sth->bindValue(":" . $key, $value);
        }
        $this->sth->execute();
        return $this->sth->rowCount();
    }

    public function delete($table, $where, $limit = 1) {
        if ($limit > 0)
            $limitRows = "LIMIT $limit";
        $sql = $this->addPrefix("DELETE FROM $table WHERE $where $limitRows");
        return $this->exec($sql);
    }

    /*private function addPrefix($sql, $prefix = '#__') {
        $output = str_replace($prefix, $this->table_prefix, $sql);
        return $output;
    }*/
    
    public function dbExist() {
        return $this->exists;
    }

    public function errorInfo() {
        return $this->sth->errorInfo();
    }

    public static function numCalls() {
        return self::$numCalls;
    }

    function __destroy() {
        $this->sth = null;
    }

}

?>