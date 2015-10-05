<?php
include_once('config.php');

class Database {
    private static $connection;

    protected static function connection() {
        if(isset($connection)) {
            $conn = self::$connection;
        } else {
            $conn = new PDO(CONNECTION, USER_NAME , PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $conn;
        }

        return $conn;
    }

    private static function queryResult($sql, $successMsg = '') {
        try{
            $conn = self::connection();
            $conn ->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            return $stmt->rowCount();
        }
        catch(PDOException $e)
        {
           return $sql . $e->getMessage();
        }
    }

    public static function insert($table, $records = array()) {

        foreach($records as $value) {
            $values[] = self::connection()->quote($value);
        }

        $values = implode(',', $values);

        $sql = "INSERT INTO $table
                VALUES (default, $values)";

        return self::queryResult($sql);
    }

    public static function select($table, $fields = "*", $conditions = array(), $where = array(), $orderby = array()) {
        $where = '1';
       //$order = implode(',', $orderby);

        if(is_array($fields)) {
            $fields = implode(',', $fields);
        }

        if(!empty($conditions)) {
            foreach($conditions as $key => $value) {
                $where .= " AND $key = '$value'";
            }
        }

        $stmt = self::connection()->prepare("SELECT $fields FROM `$table` WHERE $where");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function update($table, $fields = array(), $wheres = array()) {
        $records = self::buildFieldList($fields);
        $conditions = self::buildFieldList($wheres, " AND ");

        return self::queryResult("UPDATE {$table} SET {$records} WHERE 1 AND {$conditions}");
    }

    public static function delete($table, $fields = array()){
        $where = "";

        foreach($fields as $field){
            foreach($field as $key => $value) {
                $where .= "$key = $value AND ";
            }
        }

        $where = trim($where, ' AND ');
        $sql = "DELETE FROM $table WHERE $where";

        self::queryResult($sql);
    }

    private function buildFieldList($fields = array(), $glue = ",") {
        foreach($fields as $key => $value){
            if(is_array($value)) {
                self::buildFieldList($value, $glue);
            } else {
                $records[] = "$key = " . self::connection()->quote($value);
            }
        }

        return implode($glue, $records);
    }
}