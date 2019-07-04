<?php
// Variaveis para controle do menu e do breadcrumb
$ativo = "taxes";
$tree = "";
$page_name = "Gerenciar Impostos";
$breadcrumb = [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa-dashboard',
        'url'   => URL::getBase()
    ],
    [
        'title' => 'Gerenciar Impostos',
        'url'   => ''
    ]
];
include_once('./includes/_header.php');
include_once('./includes/Classes/Taxes.php');
// Instance Class
$Taxes = new Taxes();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <a class="btn btn-warning btn-mini" href="<?php echo URL::getBase(); ?>taxescreate">ADD <i class="fa fa-plus"></i></a>
                <table id="taxesTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Percentual</th>
                            <th>Estado</th>
                            <th>Categoria</th>
                            <th>Criado em</th>
                            <th>Atualizado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $Data = $Taxes->findTaxesAll();
                            foreach ($Data as $Value) { ?>
                        <tr>
                            <td><?php echo ($Value->value * 100).'%'; ?></td>
                            <td><?php echo $Value->name; ?></td>
                            <td><?php echo $Value->category_name; ?></td>
                            <td><?php echo date('d/m/Y H:m:s', strtotime($Value->created_at)); ?></td>
                            <?php if ($Value->updated_at == null) { ?>
                                <td>-</td>
                            <?php } else { ?>
                                <td><?php echo date('d/m/Y H:m:s', strtotime($Value->updated_at)); ?></td>
                            <?php } ?>
                            <td>
                               <div class="d-flex justify-content-center">
                                    <div class="pr-1">
                                        <button
                                        type="button" 
                                        data-toggle="modal" 
                                        data-target="#editModal"
                                        class="btn btn-warning btn-mini"
                                        data-id="<?php echo $Value->id; ?>"
                                        data-percent="<?php echo ($Value->value * 100); ?>"
                                        ><i class="fa fa-pencil"></i></button>
                                    </div>
                                    <div>
                                        <button 
                                        type="button" 
                                        class="btn btn-danger btn-mini" 
                                        data-toggle="modal" 
                                        data-target="#deleteModal" 
                                        data-id="<?php echo $Value->id; ?>"
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editModalLabel">Editar Percentual Imposto</h4>
      </div>
      <div class="modal-body">
        <form action="/" id="editForm">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Percentual*:</label>
            <input type="text" class="form-control" id="inptPercentEdit" name="inptPercentEdit">
            <input type="hidden" class="form-control" id="inptTaxId" name="inptTaxId">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-warning" id="editTax">Enviar</button>
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
        <h4 class="modal-title" id="deleteModalLabel">Você deseja deletar este imposto?</h4>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="delete" value="" id="deleteInput">
        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-warning" id="deleteTax">Sim</button>
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
<script>
$(function () {
    $('#taxesTable').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false,
        'language': {
            url: '<?php echo URL::getBase(); ?>pt-BR.json'
        }
    })
})
$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var percent = button.data('percent')
    var id = button.data('id')
    var modal = $(this)
    modal.find('#inptPercentEdit').val(percent)
    modal.find('#inptTaxId').val(id)
})
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('name')
    var id = button.data('id')
    var modal = $(this)
    modal.find('#deleteInput').val(id)
})
</script>
<script>
$('#editTax').click(function(e)
{
  var id = $('#inptTaxId').val()
  var percent = $('#inptPercentEdit').val()

  var obj = { id: id, percent: percent }
  e.preventDefault()
  $.ajax({
    url: "<?php echo URL::getBase(); ?>includes/Domains/Taxes/Controller.php",
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
$('#deleteTax').click(function(e)
{
    var id = $('#deleteInput').val()
    console.log(id)
    e.preventDefault();
    $.ajax({
        url: "<?php echo URL::getBase(); ?>includes/Domains/Taxes/Controller.php?id="+ id,
        type: 'DELETE',
        success: function (data)
        {
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
</script>
<?php include_once('./includes/_footer.php'); ?>
