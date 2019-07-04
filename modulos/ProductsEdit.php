<?php
// Variaveis para controle do menu e do breadcrumb
$ativo = "products";
$page_name = "Editar Produtos";
$breadcrumb = [
    [
        'title' => 'Dashboard',
        'url'   => URL::getBase(),
        'icon'  => 'fa-dashboard'
    ],
    [
        'title' => 'Editar Produto',
        'url'   => ''
    ]
];
require_once('./includes/Classes/Laboratories.php');
require_once('./includes/Classes/Categories.php');
require_once('./includes/Classes/Products.php');
include_once('./includes/_header.php');

$Laboratories = new Laboratories();
$Categories = new Categories();
$Products = new Products;

$ProductId = intval($_GET['id']);
$Data = $Products->find($ProductId);
var_dump($Data);
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body mt-4">
                <form id="formProduct">
                    <input type="hidden" id="intpIdProduct" name="inptIdProduct" value="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblEan">EAN*:</label>
                                <input 
                                type="number" 
                                id="inptEan" 
                                name="inptEan" 
                                class="form-control" 
                                placeholder="7891721023477" 
                                value="<?php echo $Data->ean; ?>">
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
                                placeholder="Aciclovir" 
                                value="<?php echo $Data->name; ?>" required>
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
                                placeholder="20MG C/30 CPS" 
                                value="<?php echo $Data->apresentation; ?>" required>
                            </div>                   
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblLaboratory">Laboratorio*:</label>
                                <select name="slctLaboratory" id="slctLaboratory" class="form-control">
                                    <?php
                                        $SlLabs = $Laboratories->findAll('lab_name asc');
                                        foreach ($SlLabs as $Value) {
                                            if ($Data->laboratory_id = $Value->id) {
                                    ?>
                                        <option value="<?php echo $Value->id; ?>" selected><?php echo $Value->lab_name; ?></option>
                                    <?php } elseif ($Value->id != $Data->laboratory_id) { ?>
                                        <option value="<?php echo $Value->id; ?>"><?php echo $Value->lab_name; ?></option>
                                    <?php }
                                        } ?>
                                </select>
                            </div>                   
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblCategory">Categoria*:</label>
                                <select name="slctCategory" id="slctCategory" class="form-control">
                                    <?php
                                        $SlCategory = $Categories->findAll('category_name asc');
                                        foreach ($SlCategory as $Value) {
                                            if ($Data->category_id = $Value->id) {
                                    ?>
                                        <option value="<?php echo $Value->id; ?>" selected><?php echo $Value->category_name; ?></option>
                                    <?php } elseif ($Value->id != $Data->category_id) { ?>
                                        <option value="<?php echo $Value->id; ?>"><?php echo $Value->category_name; ?></option>
                                    <?php }
                                        } ?>
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
                                value="<?php echo $Data->price; ?>"
                                placeholder="20,00" required>
                            </div>
                        </div>
                    </div>     
                </form> 
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-warning pull-right" id="editProduct">Salvar</button>
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

<script>

function pageReload()
{
    location.reload();
}

function pageCategories()
{
    window.location.href = "/categorieshome";
}

</script>
<script>
$('#editProduct').click(function(e)
{
    var id = "<?php echo $_GET['id'] ?>",
        name = $('#inptNmProduct').val(),
        apresentation = $('#inptApresentation').val(),
        ean = $('#inptEan').val(),
        category = $('#slctCategory').val(),
        laboratory = $('#slctLaboratory').val(),
        price = $('#inptPrice').val();

    var obj = {
        id: id, 
        name: name, 
        apresentation: apresentation, 
        ean: ean, 
        category: category, 
        laboratory: laboratory, 
        price: price 
    };
    
    e.preventDefault();
    $.ajax({
        url: "<?php echo URL::getBase(); ?>includes/Domains/Products/Controller.php",
        type: 'PUT',
        data: JSON.stringify(obj),
        dataType: 'JSON',
        success: function(data){
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
                pageCategories()
            });                 
        }
        }
    })
});
</script>
<?php include_once('./includes/_footer.php'); ?>