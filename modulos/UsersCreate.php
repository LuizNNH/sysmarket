<?php 
$ativo = "userscreate";
include_once('./includes/_header.php');
?>

<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Cadastro de Usuário</h3>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-warning alert-dismissible hidden" id="error-alert" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Warning!</strong> Better check yourself, you're not looking too good.
            </div>
            <form action="/" id="registerUser">
                <div class="form-group">
                    <label for="lblUsername">Usuário:</label>
                    <input type="text" class="form-control" id="inptUsername" name="inptUsername" placeholder="fulano23">
                </div>                
                <div class="form-group">
                    <label for="lblEmail">Email address</label>
                    <input type="email" class="form-control" id="inptEmail" name="inptEmail" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="lblPassword">Password</label>
                    <input type="password" class="form-control" id="inptPassword" name="inptPassword" placeholder="Password">
                </div>
                <input type="hidden" name="register" value="1">
                <button type="submit" id="click" class="btn btn-default">Cadastrar</button>
            </form>                 
            </div>
        </div>       
    </div>
</div>
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo URL::getBase(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo URL::getBase(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL::getBase(); ?>dist/js/adminlte.min.js"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
    $('#registerUser').submit(function(e){
        e.preventDefault();
        $.post(
            "/vendas/includes/domains/users/Controller.php",
            $("#registerUser").serialize()
        ).done(function(data) {
            var jsonResponse = JSON.parse(data);
            console.log(jsonResponse);
            if (jsonResponse.success == false)
            {
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: jsonResponse.message,
                })               
            }
            else
            {
                Swal.fire({
                type: 'success',
                title: 'OK!',
                text: jsonResponse.message,
                })
            }
        })
    });
    // axios.get('/test.php?ID=12345')
    // .then(function (response) {
    //     // handle success
    //     console.log(response);
    // })
    // .catch(function (error) {
    //     // handle error
    //     console.log(error);
    // })
    // .finally(function () {
    //     // always executed
    // });    
</script>
<?php include_once('./includes/_footer.php'); ?>