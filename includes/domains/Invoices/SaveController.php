<?php
header('Content-type: application/json');
include_once "../../Classes/Invoices.php";
// include_once "Validator.php";
$Invoices = new Invoices();


$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'POST':

        $User = $_POST['slctClient'];
        $State = $_POST['inptState'];
        $Product = $_POST['idProd'];
        $Quantity = $_POST['qtdProd'];
        $Hash = substr(md5(openssl_random_pseudo_bytes(20)), - 32);
        foreach ($Product as $Key => $N) {

            $Invoices->setUser($User);
            $Invoices->setProduct($N);
            $Invoices->setState($State);
            $Invoices->setQuantity($Quantity[$Key]);
            $Invoices->setHash($Hash);
            $Data = $Invoices->insert();    

        }
        if ($Data) 
        {
            $Response = [
                'status'    => true,
                'message'   => 'Venda Realizada!',
                'data'      => $Data
            ];
            echo json_encode($Response);
        } else {
            $Response = [
                'status'    => false,
                'message'   => 'Erro ao processar!',
                'data'      => $Data
            ];
            echo json_encode($Response);

        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
