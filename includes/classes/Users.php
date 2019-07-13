<?php

require_once 'Crud.php';

class Users extends Crud{

    protected $table = 'users';
    private $cpf;
    private $email;
    private $password;
    private $access;
    private $name;
    
    public function getCpf()
    {
        return $this->cpf;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAccessLevel()
    {
        return $this->access;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setAccessLevel($access)
    {
        $this->access = $access;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function insert()
    {
        $sql = "INSERT INTO $this->table (name, cpf, email, password, access_level, state_id, created_at) 
                VALUES (:name, :cpf, :email, :password, :access, :state, CURRENT_TIMESTAMP)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':access', $this->access);
        $stmt->bindParam(':state', $this->state);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function update($id)
    {
        $sql = "UPDATE $this->table SET username = :username, password = :password, email = :email WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }

    public function findByCpf()
    {
        $sql = "SELECT id FROM $this->table WHERE cpf = :cpf";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function findByEmail()
    {
        $sql = "SELECT id FROM $this->table WHERE email = :email";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getPassHash()
    {
        $sql = "SELECT password FROM $this->table WHERE email = :email";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getUserJSON($user)
    {
        $sql = "SELECT id, name 
                FROM $this->table 
                WHERE deleted_at IS NULL
                AND access_level != 8
                AND name LIKE '%".$user."%'";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function getTaxesById($id)
    {
        $sql = "SELECT usr.state_id, tx.value AS percent, ct.category_name AS category
                FROM $this->table usr
                    LEFT JOIN taxes tx ON tx.state_id = usr.state_id AND tx.deleted_at IS NULL
                    LEFT JOIN categories ct ON ct.id = tx.category_id AND ct.deleted_at IS NULL
                WHERE usr.deleted_at IS NULL
                AND usr.id = $id";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}