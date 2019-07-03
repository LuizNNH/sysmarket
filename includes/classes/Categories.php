<?php

require_once 'Crud.php';

Class Categories extends Crud{

    protected $table = 'categories';
    private $category;


    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function insert()
    {
        $sql = "INSERT INTO $this->table (category_name, created_at) VALUES (:category, CURRENT_TIMESTAMP)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':category', $this->category);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function update($id)
    {
        $sql = "UPDATE $this->table SET category_name = :category, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();

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