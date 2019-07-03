<?php
// Variaveis para controle do menu e do breadcrumb
$ativo = "taxes";
$tree = "";
$page_name = "Criar Imposto";
$breadcrumb = [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa-dashboard',
        'url'   => URL::getBase()
    ],
    [
        'title' => 'Gerenciar Impostos',
        'icon'  => 'fa-line-chart',
        'url'   => URL::getBase().'taxes'
    ],
    [
        'title' => 'Criar Imposto',
        'url'   => ''
    ]
];
include_once('./includes/_header.php');
include_once('./includes/Classes/States.php');
include_once('./includes/Classes/Categories.php');
$States = new States();
$Categories = new Categories();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <form action="/" id="formTaxes">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblPercent">Percentual*:</label>
                                <input 
                                type="number" 
                                id="inptPercent" 
                                name="inptPercent" 
                                class="form-control"
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblState">Estado Vigente*:</label>
                                <select name="slctState" id="slctState" class="form-control">
                                    <?php $Data = $States->findAll('name ASC');
                                    foreach($Data as $Value) {  
                                    ?>
                                    <option value="<?php echo $Value->id ?>"><?php echo $Value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblCategory">Categoria*:</label>
                                <select name="slctCategory" id="slctCategory" class="form-control">
                                <?php $Data = $Categories->findAll('category_name ASC');
                                foreach($Data as $Value) { ?>
                                <option value="<?php echo $Value->id; ?>"><?php echo $Value->category_name; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-warning pull-right" id="addTaxes">Enviar</button>
                        </div>
                    </div>
                </form>
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
<!-- SlimScroll -->
<script src="<?php echo URL::getBase(); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo URL::getBase(); ?>bower_components/fastclick/lib/fastclick.js"></script>

<script>
$('#addTaxes').click(function(e)
{
    e.preventDefault();
    $.post(
        "<?php echo URL::getBase(); ?>includes/Domains/Taxes/Controller.php",
        $('#formTaxes').serialize()
    ).done(function (data)
    {
        if (data.success == false) {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: data.message,
            })
            setTimeout(function () {
                location.reload();
            }, 2000);
        } else {
            Swal.fire({
                type: 'success',
                title: 'OK!',
                text: data.message,
            })
            setTimeout(function () {
                location.reload();
            }, 2000);            
        }     
    })
})

</script>

<?php include_once('./includes/_footer.php'); ?>