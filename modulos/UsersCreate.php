<?php 
$ativo = "userscreate";
$page_name = "Criar Usuário";
$breadcrumb = [
    [
        'title' => 'Dashboard',
        'url' => '/sysmarket'
    ],
    [
        'title' => 'Criar Usuário',
        'url' => ''
    ]
];


include_once('./includes/_header.php');
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <form action="" id="userForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lblName">Nome*:</label>
                                <input 
                                type="text" 
                                class="form-control"
                                id="inptName"
                                name="inptName"
                                placeholder="Fulano da Silva"
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lblName">Email*:</label>
                                <input 
                                type="email" 
                                class="form-control"
                                id="inptEmail"
                                name="inptEmail"
                                placeholder="mail@mail.com.br"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblName">CPF*:</label>
                                <input 
                                type="text" 
                                class="form-control"
                                id="inptCpf"
                                name="inptCpf"
                                placeholder="92931048062"
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblName">Senha*:</label>
                                <input 
                                type="password" 
                                class="form-control"
                                id="inptPass"
                                name="inptPass"
                                placeholder="Password"
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lblName">Tipo*:</label>
                                <select name="slctType" id="slctType" class="form-control">
                                    <option value="1">Padrão</option>
                                    <option value="8">Administrador</option>
                                </select>
                            </div>                            
                        </div>
                    </div>                    
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-warning pull-right" id="addUser">Cadastrar</button>
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
$(function () {
    $("#inptCpf")
        .popover({ content: "Somente números!" })
        .blur(function () {
            $(this).popover('hide');
        });
});
    $('#addUser').click(function(e){
        e.preventDefault();
        $.post(
            "<?php echo URL::getBase(); ?>includes/domains/users/Controller.php",
            $("#userForm").serialize()
        ).done(function(data) {
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
                })
            }
        })
    });
</script>
<?php include_once('./includes/_footer.php'); ?>