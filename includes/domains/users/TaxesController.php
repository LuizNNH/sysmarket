<?php
header('Content-type: application/json');
include_once "../../Classes/Users.php";

$Users = new Users();

$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':

        $Data = $Users->getTaxesById($_GET['id']);

        echo json_encode($Data);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
