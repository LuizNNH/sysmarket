<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "Validator.php";
include_once "../../classes/Users.php";

$Validator = new Validator();
$Users = new Users();

$request_method = $_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        if(!empty($_GET["product_id"]))
        {
            $product_id=intval($_GET["product_id"]);
        }
        else
        {
            echo "Vazio";
        }
        break;
    case 'POST':
        $Verify = $Validator->NewUser($_POST);
        if ($Verify)
        {
            echo $Verify;
        } 
        else 
        {   
            
            $response = [
                'success' => true,
                'message' => "Usuário cadastrado com sucesso!"
            ];
            echo json_encode($response);
        }
        

        break;
    case 'PUT':
        // Update Product
        $product_id=intval($_GET["product_id"]);
        break;
    case 'DELETE':
        // Delete Product
        $product_id=intval($_GET["product_id"]);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}