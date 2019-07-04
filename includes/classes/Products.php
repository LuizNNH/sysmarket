<?php

require_once 'Crud.php';

class Products extends Crud
{
    protected $table = 'products';
    private $name;
    private $apresentation;
    private $ean;
    private $laboratory;
    private $category;
    private $price;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getApresentation() {
		return $this->apresentation;
	}

	public function setApresentation($apresentation) {
		$this->apresentation = $apresentation;
	}

	public function getEan() {
		return $this->ean;
	}

	public function setEan($ean) {
		$this->ean = $ean;
	}

	public function getLaboratory() {
		return $this->laboratory;
	}

	public function setLaboratory($laboratory) {
		$this->laboratory = $laboratory;
	}

	public function getCategory() {
		return $this->category;
	}

	public function setCategory($category) {
		$this->category = $category;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($price) {
		$this->price = $price;
	}


    public function insert()
    {
        $sql = "INSERT INTO $this->table (name, apresentation, ean, laboratory_id, category_id, price, created_at) 
                VALUES (:name, :apresentation, :ean, :laboratory, :category, :price, CURRENT_TIMESTAMP)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':apresentation', $this->apresentation);
        $stmt->bindParam(':ean', $this->ean);
        $stmt->bindParam(':laboratory', $this->laboratory);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':price', $this->price);
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

    public function findByEan()
    {
        $sql = "SELECT id 
                FROM $this->table 
                WHERE ean = :ean 
                AND deleted_at IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':ean', $this->ean);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function findCategoryExists()
    {
        $sql = "SELECT id
                FROM categories
                WHERE id = :id
                AND deleted_at IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $this->category);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function findLaboratoryExists()
    {
        $sql = "SELECT id
                FROM laboratories
                WHERE id = :id
                AND deleted_at IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $this->laboratory);
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
