<?php

require_once 'Crud.php';

class Users extends Crud{

    protected $table = 'users';
    private $username;
    private $email;
    
    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setUsername($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function insert()
    {
        $sql = "INSERT INTO $this->table (username, password, email) VALUES (:username, :password, :email)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function update($id)
    {
        $sql = "UPDATE $this->table SET username = :username, password = :password, email = :email WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }
}