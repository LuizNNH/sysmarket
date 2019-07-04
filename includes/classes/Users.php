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

    public function setCpf($cpf)
    {
        $this->username = $username;
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

    public function insert()
    {
        $sql = "INSERT INTO $this->table (name, cpf, email, password, access_level, created_at) 
                VALUES (:name, :cpf, :email, :password, :access, CURRENT_TIMESTAMP)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':access', $this->access);
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
}