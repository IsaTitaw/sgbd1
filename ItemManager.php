<?php


abstract class ItemManager
{
    protected $table;
    protected $connection;
    protected $item_list;

    function __construct($tableName) {
        $this->table = $tableName;
        $this->connection = new PDO('mysql:host=localhost;dbname=sqli', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->item_list = array();
    }

    function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($results as $item) {
                array_push($this->item_list, $this->create($item));
            }

            return $this->item_list;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function fetch($pk) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->create($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function delete($pk) {
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
            $statement->bindValue(1, $pk, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        return false;
    }

    abstract protected function create($item);
}