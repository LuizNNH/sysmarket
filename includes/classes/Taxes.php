<?php

require_once 'Crud.php';

class Taxes extends Crud
{
    protected $table = 'taxes';
    private $tax;
    private $state;
    private $category;


    public function getTax()
    {
        return $this->tax;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function insert()
    {
        $sql = "INSERT INTO $this->table (state_id, category_id, value, created_at) VALUES (:state, :category, :tax, CURRENT_TIMESTAMP)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':tax', $this->tax);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function update($id)
    {
        $sql = "UPDATE $this->table SET category_name = :category, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function findByStateAndCategory()
    {
        $sql = "SELECT id FROM $this->table WHERE category_id = :category AND state_id = :state";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':state', $this->state);
        $stmt->execute();
        return $stmt->rowCount();
    }
}

