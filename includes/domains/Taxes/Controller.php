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
            $FormatTax = str_replace(",", ".", $_POST['inptPercent']);
            $Tax = ($FormatTax / 100);
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
            }
            else {
                $response = [
                    'success' => false,
                    'message' => "Erro na query contate administrador!"
                ];   
            }
            echo json_encode($response);
        }
        break;
    case 'PUT':
        $json = file_get_contents('php://input');
        $obj  = json_decode($json, true);
        if ($obj['percent'] == "" or $obj['id'] == "")
        {
            $response = [
                'success' => false,
                'message' => 'Nada a Alterar!'
            ];
            echo json_encode($response);
        }
        else 
        {
            $FormatTax = str_replace(",", ".", $obj['percent']);
            $Tax = ($FormatTax / 100);
            $Taxes->setTax($Tax);
            $response = $Taxes->update($obj['id']);
            if ($response)
            {
                $response = [
                    'success' => true,
                    'message' => 'Alterada com Sucesso!'
                ];
                echo json_encode($response);  
            } 
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'Erro ao processar a Query'
                ];
            echo json_encode($response);
            }
        }
        break;
    case 'DELETE':
        $tax_id = intval($_GET["id"]);
        $response = $Taxes->delete($tax_id);
        if ($response)
        {
            $response = [
                'success' => true,
                'message' => 'Imposto Deletada!'
            ];
            echo json_encode($response);
        } 
        else
        {
            $response = [
                'success' => false,
                'message' => 'Nenhuma imposto encontrado para este id!'
            ];
            echo json_encode($response);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}