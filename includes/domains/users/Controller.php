<?php
header('Content-type: application/json');

include_once "Validator.php";
include_once "../../Classes/Users.php";
include_once "Utils.php";

$Validator = new Validator();
$Users = new Users();

$request_method = $_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        $Query = strtoupper($_GET['q']);
        $Json = [];
        $Data = $Users->getUserJSON($Query);
            foreach ($Data as $Value)
            {
                $Json[] = [
                    'id' => $Value->id,
                    'text' => $Value->name
                ];
            }
        echo json_encode($Json);
        break;
    case 'POST':
        $Verify = $Validator->NewUser($_POST);
        if ($Verify)
        {
            echo $Verify;
        } 
        else 
        {   
            $Password = Utils::parsePassword($_POST['inptPass']);
            $Name = Utils::toUpperCase($_POST['inptName']);
            $Cpf = Utils::removeBadChars($_POST['inptCpf']);

            $Users->setName($Name);
            $Users->setCpf($Cpf);
            $Users->setEmail($_POST['inptEmail']);
            $Users->setPassword($Password);
            $Users->setAccessLevel($_POST['slctType']);
            $Users->setState($_POST['slctState']);
            $response = $Users->insert();
            if ($response)
            {
                $response = [
                    'success' => true,
                    'message' => "Usuário cadastrado com sucesso!"
                ];
                echo json_encode($response);
            }

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