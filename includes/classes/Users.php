<?php

require_once 'Crud.php';

class Users extends Crud{

    protected $table = 'users';
    private $username;
    private $email;
    private $password;
    
    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setUsername($username)
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

    public function insert()
    {
        $sql = "INSERT INTO $this->table (username, password, email) VALUES (:username, :password, :email)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        return $stmt->execute();
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

    public function findByUsername()
    {
        $sql = "SELECT user_id FROM $this->table WHERE username = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findByEmail()
    {
        $sql = "SELECT user_id FROM $this->table WHERE email = :email";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        return $stmt->fetch();
    }
}