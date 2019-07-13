<?php
header('Content-type: application/json');
include_once "../../Classes/Products.php";
session_start();

$Products = new Products();

$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'POST':

        $Response = array();
        $Response['data'] = '';
        if (isset($_SESSION['cart'][$_POST['id']]) and $_POST['action'] == "del")
        {
            
            unset($_SESSION['cart'][$_POST['id']]);

        } elseif (isset($_SESSION['cart'][$_POST['id']]) and $_POST['action'] == "up") {

            if ($_POST['value'] == 0)
            {
                unset($_SESSION['cart'][$_POST['id']]);

            } else {

                $_SESSION['cart'][$_POST['id']] = $_POST['value'];
            }

        } else {

            if (isset($_SESSION['cart'][$_POST['id']])) {
                $_SESSION['cart'][$_POST['id']] += 1;
            } else {
                $_SESSION['cart'][$_POST['id']] = 1;
            }
        }
        $TotalProducts = 0;
        $TotalTaxProducts = 0;
        foreach ($_SESSION['cart'] as $ProductId => $Qtd) {
            $Data = $Products->findByStateAndId($ProductId, $_POST['state']);
            $PriceTotal = ($Qtd * $Data->price);
            $PriceWithTaxTotal = ($Qtd * $Data->pricewithtax);
            $TotalProducts += number_format($PriceTotal, 2, '.', ',');
            $TotalTaxProducts += number_format($PriceWithTaxTotal, 2, '.', ',');
            $Response['data'] .= "<tr>";
            $Response['data'] .= '<td><input type="hidden" name="nameProd[]" value="'.$Data->name.'">'.$Data->name.'</td>';
            $Response['data'] .= '<td><input type="hidden" name="apresentationProd[]" value="'.$Data->apresentation.'">'.$Data->apresentation.'</td>';
            $Response['data'] .= '<td><input type="hidden" name="labProd[]" value="'.$Data->lab_name.'">'.$Data->lab_name.'</td>';
            $Response['data'] .= '<td><input type="hidden" name="vlrUnProd[]" value="'.number_format($Data->price, 2, ',', '.').'">R$'.number_format($Data->price, 2, ',', '.').'</td>';
            $Response['data'] .= '<td><input type="hidden" name="vlrUnTaxProd[]" value="'.number_format($Data->pricewithtax, 2, ',', '.').'">R$'.number_format($Data->pricewithtax, 2, ',', '.').' ('.$Data->percent.'% - '.$Data->uf.')</td>';
            $Response['data'] .= '<td width="5%"><input type="hidden" name="qtdProd[]" value="'.$Qtd.'"><input type="number" class="form-control" id="inptQtd" value="'.$Qtd.'" onChange="setUpdate('.$ProductId.', '.$Data->id_state.', this.value)"></td>';
            $Response['data'] .= '<td><input type="hidden" name="totalProd[]" value="'.number_format(($Qtd * $Data->price), 2, ',', '.').'">R$'.number_format(($Qtd * $Data->price), 2, ',', '.').'</td>';
            $Response['data'] .= '<td><input type="hidden" name="totalTaxProd[]" value="'.number_format(($Qtd * $Data->pricewithtax), 2, ',', '.').'">R$'.number_format(($Qtd * $Data->pricewithtax), 2, ',', '.').'</td>';
            $Response['data'] .= '<td class="text-center"><button type="button" onClick="delProduct('.$ProductId.', '.$Data->id_state.')" mame="delProduct" class="btn btn-danger"><i class="fa fa-fw fa-remove"></i></button></td>';
            $Response['data'] .= '<input type="hidden" name="idProd[]" value="'.$ProductId.'"><input type="hidden" name="stateProd[]" value="'.$Data->id_state.'">';
            $Response['data'] .= "</tr>";
        }

        $Response['data'] .= '<tr><td colspan=2><span class="pull-right"><b>Total Produtos</b></span></td><td><span class="highlight-text">R$'.$TotalProducts.'</span></td>';
        $Response['data'] .= '<td colspan=2><span class="pull-right"><b>Total C/ Impostos</b></span></td><td><span class="highlight-text">R$'.$TotalTaxProducts.'</span></td>';
        $Response['data'] .= '<td colspan=2><span class="pull-right"><b>Total de Impostos</b></span></td><td><span class="highlight-text">R$'.($TotalTaxProducts - $TotalProducts).'</span></td></tr>';
        

        echo json_encode($Response);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
