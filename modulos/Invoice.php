<?php
// Variaveis para controle do menu e do breadcrumb
$ativo = "invoices";
$page_name = "Vendas";
$breadcrumb = [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa-dashboard',
        'url'   => URL::getBase()
    ],
    [
        'title' => 'Vendas',
        'url'   => ''
    ]
];
include_once('./includes/_header.php');
@session_start();
session_destroy();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <form action="" id="invoiceForm">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Selecione o cliente*:</label>
                                <select id="slctClient" name="slctClient" class="form-control select2"></select>
                                <input type="hidden" name="inptState" id="inptState">
                            </div>        
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lblProduct">Busque o Produto*:</label>
                                <div class="input-group">
                                    <select name="slctProduct" id="slctProduct" class="form-control select2">                                
                                    </select>
                                    <div class="input-group-addon warning" role="button" id="addNewProduct">
                                    <i class="fa fa-plus-circle"></i>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr >
                                        <th class="text-center">Nome</th>
                                        <th class="text-center">Apresentação</th>
                                        <th class="text-center">Laboratório</th>
                                        <th class="text-center">Valor Un.</th>
                                        <th class="text-center">Valor Un + Imposto</th>
                                        <th class="text-center">Qtd</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Total C/ Imposto</th>
                                        <th class="text-center">Remover</th>
                                    </tr>
                                </thead>
                                <tbody id="products_body">
                                </tbody>
                            </table>  
                        </div>
                      
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-warning pull-right" id="addInvoice">Finalizar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- REQUIRED JS SCRIPTS -->
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.13.0/dist/sweetalert2.min.js"></script>
<!-- jQuery 3 -->
<script src="<?php echo URL::getBase(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo URL::getBase(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL::getBase(); ?>dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="<?php echo URL::getBase(); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo URL::getBase(); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo URL::getBase(); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo URL::getBase(); ?>bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo URL::getBase(); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo URL::getBase(); ?>dist/js/redirects.js"></script>
<script>
$('#slctClient').select2({
        placeholder: 'Selecione um cliente',
        ajax: {
          url: '<?php echo URL::getBase(); ?>includes/Domains/Users/Controller.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }        
});

$('#slctProduct').select2({
        placeholder: 'Busque por um produto',
        ajax: {
          url: "<?php echo URL::getBase(); ?>includes/Domains/Products/Controller.php",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }        
});
$('#slctClient').change(function ()
{
    let id = $('#slctClient').val();
    $.get(
        `<?php echo URL::getBase(); ?>includes/Domains/Users/TaxesController.php?id=${id}`
    ).done(function (data){
        let state = data[0].state_id;
        $('#inptState').val(state);
    })
})

$('#addNewProduct').click(function (e)
{
    var id = $('#slctProduct').val(),
        state = $('#inptState').val(),
        client = $('#slctClient').val();
    e.preventDefault();

    $.post(
        "<?php echo URL::getBase(); ?>includes/Domains/Invoices/Controller.php",
        { id: id, state: state, client: client }
    ).done(function (response){
        $('tbody#products_body').html(response.data);
    })
    
});

$('#addInvoice').click(function (e){

    e.preventDefault();

    $.post(
        "<?php echo URL::getBase(); ?>includes/Domains/Invoices/SaveController.php",
        $('#invoiceForm').serialize()
    ).done(function (response){
        if (response.success == false)
        {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: response.message,
            })
        }
        else
        {
            Swal.fire({
                type: 'success',
                title: 'OK!',
                text: response.message,
            }).then(function() {
                pageDash()
            });                 
        }
    })
});


function delProduct(id, state)
{
    $.post(
        "<?php echo URL::getBase(); ?>includes/Domains/Invoices/Controller.php",
        { id: id, state: state, action: "del" }
    ).done(function (response){
        $('tbody#products_body').html(response.data);
    })
}

function setUpdate(id, state, value) {
    $.post(
        "<?php echo URL::getBase(); ?>includes/Domains/Invoices/Controller.php",
        { id: id, state: state, action: "up", value: value }
    ).done(function (response){
        $('tbody#products_body').html(response.data);
    });
}
</script>
<?php include_once('./includes/_footer.php'); ?>
