<?php
header('Content-type: application/json');
require_once "Validator.php";
require_once "../../Classes/Categories.php";

$Categories = new Categories();
$Validator = new Validator();


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
        $Verify = $Validator->NewCategory($_POST);
        if ($Verify) {
            echo $Verify;
        } else {
            $Categories->setCategory($_POST['inptCategoryNm']);
            $Categories->insert();
            $response = [
                'success' => true,
                'message' => "Categoria Cadastrada!"
            ];
            echo json_encode($response);
        }
        break;
    case 'PUT':
        
        $json = file_get_contents('php://input');
        $obj  = json_decode($json, true);
        if ($obj['category'] == "" or $obj['id'] == "")
        {
            $response = [
                'success' => false,
                'message' => 'Nada a Alterar!'
            ];
            echo json_encode($response);
        }
        else 
        {
            $Categories->setCategory($obj['category']);
            $response = $Categories->update($obj['id']);
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
    
        $category_id = intval($_GET["id"]);
        $response = $Categories->delete($category_id);
        if ($response)
        {
            $response = [
                'success' => true,
                'message' => 'Categoria Deletada!'
            ];
            echo json_encode($response);
        } 
        else
        {
            $response = [
                'success' => false,
                'message' => 'Nenhuma categoria encontrada para este id!'
            ];
            echo json_encode($response);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
