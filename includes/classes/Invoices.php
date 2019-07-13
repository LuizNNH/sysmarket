<?php 

require_once "Crud.php";

class Invoices extends Crud
{

    protected $table = 'invoices';
    private $user;
    private $product;
    private $state;
    private $quantity;
    private $hash;

	public function getUser() {
		return $this->user;
	}

	public function setUser($user) {
		$this->user = $user;
	}

	public function getProduct() {
		return $this->product;
	}

	public function setProduct($product) {
		$this->product = $product;
	}

	public function getState() {
		return $this->state;
	}

	public function setState($state) {
		$this->state = $state;
	}

	public function getQuantity() {
		return $this->quantity;
	}

	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}

	public function getHash() {
		return $this->hash;
	}

	public function setHash($hash) {
		$this->hash = $hash;
    }
    
    public function insert()
    {
        $sql = "INSERT INTO $this->table (user_id, product_id, state_id, qtd_product, hash_invoice, created_at)
                VALUES(:user, :product, :state, :qtd, :hash, CURRENT_TIMESTAMP)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':user', $this->user);
        $stmt->bindParam(':product', $this->product);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':qtd', $this->quantity);
        $stmt->bindParam(':hash', $this->hash);
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
    
}