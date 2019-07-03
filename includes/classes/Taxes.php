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
        $sql = "INSERT INTO $this->table (state_id, category_id, value, created_at) 
                VALUES (:state, :category, :tax, CURRENT_TIMESTAMP)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':tax', $this->tax);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function update($id)
    {
        $sql = "UPDATE $this->table 
                    SET value = :tax, updated_at = CURRENT_TIMESTAMP 
                WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':tax', $this->tax);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function findByStateAndCategory()
    {
        $sql = "SELECT id 
                FROM $this->table 
                WHERE category_id = :category 
                AND state_id = :state 
                AND deleted_at IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':state', $this->state);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function findTaxesAll()
    {
        $sql = "SELECT tx.id, tx.value, tx.created_at, tx.updated_at, ct.category_name, st.name 
                FROM $this->table tx
                    JOIN states st ON st.id = tx.state_id
                    JOIN categories ct ON ct.id = tx.category_id
                WHERE tx.deleted_at IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

