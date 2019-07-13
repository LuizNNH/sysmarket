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
                    SET name = :name, 
                    apresentation = :apresentation,
                    ean = :ean,
                    laboratory_id = :laboratory,
                    category_id = :category,
                    price = :price,
                    updated_at = CURRENT_TIMESTAMP 
                WHERE id = $id";
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

    public function findProductsAll()
    {
        $sql = "SELECT pd.id, pd.name, pd.apresentation, pd.price, pd.created_at, pd.updated_at, lb.lab_name
                FROM $this->table pd
                    JOIN laboratories lb ON lb.id = pd.laboratory_id
                WHERE pd.deleted_at IS NULL
                ORDER BY pd.name ASC, lb.lab_name";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findByStateAndId($id, $state_id)
    {
        $sql = "SELECT pd.id, pd.name, pd.apresentation, pd.price, lb.lab_name, st.uf, st.id AS id_state,
                CASE
                    WHEN tx.value IS NULL THEN pd.price
                    WHEN tx.value <> 0 THEN (pd.price * (tx.value + 1))
                    ELSE pd.price
                END AS priceWithTax,
                CASE 
                    WHEN tx.value IS NULL THEN 0
                    WHEN tx.value <> 0 THEN (tx.value * 100)
                END AS percent
                FROM $this->table pd
                    LEFT JOIN taxes tx ON tx.state_id = $state_id AND tx.category_id = pd.category_id AND tx.deleted_at IS NULL
                    LEFT JOIN states st ON st.id = $state_id
                    JOIN laboratories lb ON lb.id = pd.laboratory_id AND lb.deleted_at IS NULL
                WHERE pd.id = $id";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findProductsByName($name)
    {
        $sql = "SELECT pd.id, pd.name, pd.apresentation, lb.lab_name
                FROM $this->table pd
                    JOIN laboratories lb ON lb.id = pd.laboratory_id AND lb.deleted_at IS NULL
                WHERE name LIKE '%".$name."%'
                AND pd.deleted_at IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();        
    }
}

