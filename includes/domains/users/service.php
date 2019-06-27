<?php
require_once 'validator.php';


$Validate = new Validator();
$Page_Failed = "/index.php";

if($_POST['register'])
{
    if($_POST['username'] or $_POST['email'] or $_POST['password'] == "")
    {
        $data = [
            'username' => $_POST['username'],
            'email'    => $_POST['email'],
            'password' => $_POST['password']
        ];
        echo $Validate->NewUser($data);
    }
}