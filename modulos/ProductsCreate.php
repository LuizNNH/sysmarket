<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Variaveis para controle do menu e do breadcrumb
$ativo = "productshome";
$page_name = "Cadastro de Produtos";
$breadcrumb = [
    [
        'title' => 'Dashboard',
        'url'   => URL::getBase(),
        'icon'  => 'fa-dashboard'
    ],
    [
        'title' => 'Gerenciar Produtos',
        'url'   => URL::getBase().'productshome',
        'icon'  => 'fa-bookmark'
    ],
    [
        'title' => 'Cadastrar Produto',
        'url'   => ''
    ]    
];
require_once('./includes/classes/Laboratories.php');
require_once('./includes/classes/Categories.php');
include_once('./includes/_header.php');

$Laboratories = new Laboratories();
$Categories = new Categories();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <a class="btn btn-warning btn-mini" href="<?php echo URL::getBase(); ?>productshome"><i class="fa fa-arrow-left"></i> Voltar</a>
                <form id="formProduct">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblEan">EAN*:</label>
                                <input 
                                type="number" 
                                id="inptEan" 
                                name="inptEan" 
                                class="form-control" 
                                placeholder="7891721023477" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblNmProduct">Nome Produto*:</label>
                                <input 
                                type="text" 
                                class="form-control" 
                                id="inptNmProduct" 
                                name="inptNmProduct" 
                                placeholder="Aciclovir" required>
                            </div>                   
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblApresentation">Apresentação*:</label>
                                <input 
                                type="text" 
                                class="form-control" 
                                id="inptApresentation" 
                                name="inptApresentation" 
                                placeholder="20MG C/30 CPS" required>
                            </div>                   
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblLaboratory">Laboratorio*:</label>
                                <select name="slctLaboratory" id="slctLaboratory" class="form-control">
                                    <?php 
                                        $Data = $Laboratories->findAll('lab_name asc');
                                        foreach($Data as $Value) { 
                                    ?>
                                        <option value="<?php echo $Value->id; ?>"><?php echo $Value->lab_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>                   
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblCategory">Categoria*:</label>
                                <select name="slctCategory" id="slctCategory" class="form-control">
                                    <?php 
                                        $Data = $Categories->findAll('category_name asc');
                                        foreach($Data as $Value) { 
                                    ?>
                                        <option value="<?php echo $Value->id; ?>"><?php echo $Value->category_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>                   
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblPrice">Preço*:</label> 
                                <input 
                                type="number" 
                                id="inptPrice" 
                                name="inptPrice" 
                                class="form-control" 
                                placeholder="20,00" required>
                            </div>
                        </div>
                    </div>     
                </form> 
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-warning pull-right" id="createProduct">Cadastrar</button>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
</div>

<!-- REQUIRED JS SCRIPTS -->
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
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
<script src="<?php echo URL::getBase(); ?>dist/js/redirects.js"></script>
<script>
$('#createProduct').click(function(e)
{
    e.preventDefault();
    $.post(
        "<?php echo URL::getBase(); ?>includes/Domains/Products/Controller.php",
        $('#formProduct').serialize()
    ).done(function (data){
        if (data.success == false)
        {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: data.message,
            })
        }
        else
        {
            Swal.fire({
                type: 'success',
                title: 'OK!',
                text: data.message,
            }).then(function() {
                pageProducts()
            });                 
        }  
    })
})
</script>
<?php include_once('./includes/_footer.php'); ?>