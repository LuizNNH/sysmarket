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
$States = new States();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lblPercent">Percentual*:</label>
                                <input type="text" id="inptPercent" name="inptPercent" class="form-control" placeholder="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lblState">Estado Vigente*:</label>
                                <select name="slctState" id="slctState">
                                    <?php $Data = $States->findAll();
                                    foreach($Data as $Value) {  
                                    ?>
                                    <option value="<?php echo $Value->id ?>"><?php echo $Value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
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
<!-- DataTables -->
<script src="<?php echo URL::getBase(); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo URL::getBase(); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo URL::getBase(); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo URL::getBase(); ?>bower_components/fastclick/lib/fastclick.js"></script>

<?php include_once('./includes/_footer.php'); ?>