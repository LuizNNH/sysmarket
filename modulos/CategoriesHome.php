<?php
// Variaveis para controle do menu e do breadcrumb
$ativo = "categorieshome";
$tree = "";
$page_name = "Gerenciar Categorias";
$breadcrumb = [
    [
        'title' => 'Dashboard',
        'url' => '/sysmarket'
    ],
    [
        'title' => 'Gerenciar Categorias',
        'url' => ''
    ]
];
include_once('./includes/_header.php');
include_once('./includes/Classes/Categories.php');

$Categories = new Categories();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <a data-toggle="modal" data-target="#create-modal" class="btn btn-warning btn-mini" role="button">ADD <i class="fa fa-plus"></i></a>
                <table id="categoriesTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome Categoria</th>
                            <th>Criado em</th>
                            <th>Atualizado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $Data = $Categories->findAll();
                            foreach($Data as $Value) { 
                        ?>
                        <tr>
                            <td><?php echo $Value->category_name; ?></td>
                            <td><?php echo date('d/m/Y H:m:s', strtotime($Value->created_at)); ?></td>
                            <td><?php echo $Value->updated_at; ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <div class="pr-1">
                                        <button 
                                        type="button" 
                                        class="btn btn-warning btn-mini" 
                                        data-toggle="modal" 
                                        data-target="#editModal" 
                                        data-id="<?php echo $Value->id; ?>"
                                        data-name="<?php echo $Value->category_name; ?>"
                                        ><i class="fa fa-pencil"></i></button>
                                    </div>
                                    <div>
                                        <button 
                                        type="button" 
                                        class="btn btn-danger btn-mini" 
                                        data-toggle="modal" 
                                        data-target="#deleteModal" 
                                        data-id="<?php echo $Value->id; ?>"
                                        data-name="<?php echo $Value->category_name; ?>"
                                        ><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cadastrar Categoria</h4>
      </div>
      <div class="modal-body">
        <form action="/" id="registerCategory">
            <div class="form-group">
                <div class="form-group">
                    <label for="lblCategoryNm">Nome Categoria*:</label>
                    <input type="text" class="form-control" id="inptCategoryNm" name="inptCategoryNm" placeholder="Outros ...">
                </div>                 
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="closeModal">Fechar</button>
        <button type="button" class="btn btn-warning" id="addCategory">Cadastrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editModalLabel">Editar Categoria</h4>
      </div>
      <div class="modal-body">
        <form action="/" id="editForm">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nome Categoria:</label>
            <input type="text" class="form-control" id="inptCategoryEdit" name="inptCategoryEdit">
            <input type="hidden" class="form-control" id="inptCategoryId" name="inptCategoryId">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-warning" id="editCategory">Enviar</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteModalLabel">Você deseja deletar</h4>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="delete" value="" id="deleteInput">
        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-warning" id="deleteCategory">Sim</button>
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

<script src="<?php echo URL::getBase(); ?>dist/js/pages/categories.js"></script>
<script>
$('#addCategory').click(function () {
    if ($('#inptCategoryNm').val() == "") {
        $('.form-group').addClass('has-warning')
    }
    else {
        $.post(
            "<?php echo URL::getBase(); ?>includes/Domains/Categories/Controller.php",
            $('#registerCategory').serialize()
        ).done(function (data) {
            if (data.success == false) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: data.message,
                })
            } else {
                Swal.fire({
                    type: 'success',
                    title: 'OK!',
                    text: data.message,
                })
            }
            setTimeout(function () {
              location.reload();
            }, 2000);
        })
    }
})

$('#editCategory').click(function(e){
  var id = $('#inptCategoryId').val()
  var category = $('#inptCategoryEdit').val()

  var obj = { id: id, category: category }
  e.preventDefault()
  $.ajax({
    url: "<?php echo URL::getBase(); ?>includes/Domains/Categories/Controller.php",
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
          })                 
      }
      setTimeout(function () {
          location.reload();
      }, 2000);
    }
  })
})
$('#deleteCategory').click(function(e){
    var id = $('#deleteInput').val()
    e.preventDefault();
    $.ajax({
        url: "<?php echo URL::getBase(); ?>includes/Domains/Categories/Controller.php?id="+ id,
        type: 'DELETE',
        success: function (data) {
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
            setTimeout(function () {
                location.reload();
            }, 2000);
        }
    });
})
</script>
<?php include_once('./includes/_footer.php'); ?>