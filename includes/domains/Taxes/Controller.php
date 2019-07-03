<?php
header('Content-type: application/json');

include_once "Validator.php";
include_once "../../Classes/Taxes.php";

// Instance Classes
$Validator = new Validator();
$Taxes = new Taxes();


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

        $Verify = $Validator->NewTax($_POST);
        if ($Verify)
        {
            echo $Verify;
        } 
        else 
        {
            $Tax = ($_POST['inptPercent'] / 100);
            $Taxes->setTax($Tax);
            $Taxes->setCategory($_POST['slctCategory']);
            $Taxes->setState($_POST['slctState']);
            $response = $Taxes->insert();
            if ($response)
            {
                $response = [
                    'success' => true,
                    'message' => "Imposto cadastrado com sucesso!"
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