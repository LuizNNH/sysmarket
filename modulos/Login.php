<?php 
include_once "./includes/classes/Url.php";

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo URL::getBase(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL::getBase(); ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo URL::getBase(); ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL::getBase(); ?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo URL::getBase(); ?>plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Pharma</b>Market</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Logue-se para acessar o sistema</p>

    <form action="/" method="post" id="loginForm">
      <div class="form-group has-feedback">
        <input 
        type="email" 
        class="form-control" 
        placeholder="Email" 
        id="inptEmail" 
        name="inptEmail">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input 
        type="password" 
        class="form-control" 
        placeholder="Password"
        id="inptPass"
        name="inptPass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-offset-8 col-xs-4">
          <button type="submit" class="btn btn-warning btn-block btn-flat" id="login">Logar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- jQuery 3 -->
<script src="<?php echo URL::getBase(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo URL::getBase(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo URL::getBase(); ?>plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo URL::getBase(); ?>dist/js/redirects.js"></script>
<script>
$('#login').click(function (e){
    e.preventDefault();
    $.post(
        "<?php echo URL::getBase(); ?>includes/Domains/ACL/Controller.php",
        $('#loginForm').serialize()
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
                pageDash()
            });                 
        }        
    })
})
</script>
</body>
</html>
