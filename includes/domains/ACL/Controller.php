<?php
header('Content-type: application/json');
require_once "Validator.php";
require_once "../../Classes/Users.php";
$Validator = new Validator();
$Users = new Users();

$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'POST':
        
        $Verify = $Validator->checkForm($_POST);
        if ($Verify)
        {
            echo $Verify;
        } else {
            session_start();
            $_SESSION['user']['logado'] = true;
            echo $Validator->tryLogin($_POST);
            
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
