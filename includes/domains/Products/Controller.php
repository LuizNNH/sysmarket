<?php
header('Content-type: application/json');
include_once "Validator.php";
include_once "../../Classes/Products.php";

$Validator = new Validator();
$Products = new Products();

$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["product_id"])) {
            $product_id=intval($_GET["product_id"]);
        } else {
            echo "Vazio";
        }
        break;
    case 'POST':
        $Verify = $Validator->NewProduct($_POST);
        if ($Verify) {
            echo $Verify;
        } else {
            $Name = strtoupper($_POST['inptNmProduct']);
            $Apresentation = strtoupper($_POST['inptApresentation']);
            $FormatPrice = str_replace(",", ".", $_POST['inptPrice']);

            $Products->setName($Name);
            $Products->setApresentation($Apresentation);
            $Products->setEan($_POST['inptEan']);
            $Products->setCategory($_POST['slctCategory']);
            $Products->setLaboratory($_POST['slctLaboratory']);
            $Products->setPrice($FormatPrice);
            $response = $Products->insert();
            $response = [
                'success' => true,
                'message' => "Produto cadastrado com successo!"
            ];
            echo json_encode($response);
        }
        break;
    case 'PUT':
        $json = file_get_contents('php://input');
        $obj  = json_decode($json, true);
        $Verify = $Validator->UpdateProduct($obj);
        if ($Verify)
        {
            echo $Verify;
        } else {
            $Name = strtoupper($obj['name']);
            $Apresentation = strtoupper($obj['apresentation']);
            $FormatPrice = str_replace(",", ".", $obj['price']);

            $Products->setName($Name);
            $Products->setApresentation($Apresentation);
            $Products->setEan($obj['ean']);
            $Products->setCategory($obj['category']);
            $Products->setLaboratory($obj['laboratory']);
            $Products->setPrice($FormatPrice);
            $response = $Products->update($obj['id']);
            $response = [
                'success' => true,
                'message' => "Produto alterado com sucesso!"
            ];
            echo json_encode($response);
        }
        break;
    case 'DELETE':
        $product_id = intval($_GET["id"]);
        $response = $Products->delete($product_id);
        if ($response)
        {
            $response = [
                'success' => true,
                'message' => 'Produto Deletado!'
            ];
            echo json_encode($response);
        } 
        else
        {
            $response = [
                'success' => false,
                'message' => 'Nenhum imposto encontrado para este id!'
            ];
            echo json_encode($response);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
