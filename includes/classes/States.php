<?php

require_once 'Crud.php';

class States extends Crud
{
    protected $table = 'states';
    private $state;
    private $uf;
    private $id;


    public function getState()
    {
        return $this->state;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function insert()
    {
        $sql = "INSERT INTO $this->table (category_name, created_at) VALUES (:category, CURRENT_TIMESTAMP)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':category', $this->category);
        return $stmt->execute();
    }

    public function update($id)
    {
        $sql = "UPDATE $this->table SET category_name = :category, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function findByName()
    {
        $sql = "SELECT id FROM $this->table WHERE category_name = :category";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':category', $this->category);
        $stmt->execute();
        return $stmt->fetch();
    }
}
