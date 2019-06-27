<?php 
include_once('includes/_header.php');
?>

<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Cadastro de Usuário</h3>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <form method="POST" action="/includes/domains/users/service.php">
                <div class="form-group">
                    <label for="lblUsername">Usuário:</label>
                    <input type="text" class="form-control" id="inptUsername" name="inptUsername" placeholder="fulano23">
                </div>                
                <div class="form-group">
                    <label for="lblEmail">Email address</label>
                    <input type="email" class="form-control" id="inptEmail" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="lblPassword">Password</label>
                    <input type="password" class="form-control" id="inptPassword" placeholder="Password">
                </div>
                <input type="hidden" name="register" value="1">
                <button type="submit" class="btn btn-default">Submit</button>
            </form>                 
            </div>
        </div>       
    </div>
</div>

<?php include_once('includes/_footer.php'); ?>