<?php

require_once 'DB.php';

abstract class Crud extends DB{

    protected $table;

    abstract public function insert();
    abstract public function update($id);

    public function find($id)
    {
        $sql = "SELEC * FROM $this->table WHERE id = :id AND deleted_at IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function findAll($order)
    {
        $sql = "SELECT * FROM $this->table WHERE deleted_at IS NULL ORDER BY $order";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($id)
    {
        $sql = "UPDATE $this->table SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}