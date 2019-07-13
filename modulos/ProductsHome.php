<?php
// Variaveis para controle do menu e do breadcrumb
$ativo = "productshome";
$page_name = "Gerenciar Produtos";
$breadcrumb = [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa-dashboard',
        'url'   => URL::getBase()
    ],
    [
        'title' => 'Gerenciar Produtos',
        'url'   => ''
    ]
];
include_once('./includes/_header.php');
include_once('./includes/Classes/Products.php');
// Instance Class
$Products = new Products();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-body">
                <a class="btn btn-warning btn-mini" href="<?php echo URL::getBase(); ?>productscreate">ADD <i class="fa fa-plus"></i></a>
                <table id="productsTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Apresentação</th>
                            <th>Laboratório</th>
                            <th>Valor</th>
                            <th>Criado em</th>
                            <th>Atualizado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $Data = $Products->findProductsAll();
                            foreach ($Data as $Value) { ?>
                        <tr>
                            <td><?php echo $Value->name; ?></td>
                            <td><?php echo $Value->apresentation; ?></td>
                            <td><?php echo $Value->lab_name; ?></td>
                            <td>R$ <?php echo number_format($Value->price, 2, ',', '.'); ?></td>
                            <td><?php echo date('d/m/Y H:m:s', strtotime($Value->created_at)); ?></td>
                            <?php if ($Value->updated_at == null) { ?>
                                <td>-</td>
                            <?php } else { ?>
                                <td><?php echo date('d/m/Y H:m:s', strtotime($Value->updated_at)); ?></td>
                            <?php } ?>
                            <td>
                               <div class="d-flex justify-content-center">
                                    <div class="pr-1">
                                        <a
                                        class="btn btn-warning btn-mini"
                                        href="<?php echo URL::getBase(); ?>productsedit?id=<?php echo $Value->id; ?>"
                                        ><i class="fa fa-pencil"></i></a>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteModalLabel">Você deseja deletar este produto?</h4>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="delete" value="" id="deleteInput">
        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-warning" id="deleteProduct">Sim</button>
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
<script src="<?php echo URL::getBase(); ?>dist/js/redirects.js"></script>
<script>
$(function () {
    $('#productsTable').DataTable({
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
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var modal = $(this)
    modal.find('#deleteInput').val(id)
})
</script>
<script>
$('#deleteProduct').click(function(e)
{
    var id = $('#deleteInput').val()
    e.preventDefault();
    $.ajax({
        url: "<?php echo URL::getBase(); ?>includes/Domains/Products/Controller.php?id="+ id,
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
                }).then(function() {
                    pageProducts()
                });                 
            }         
        }
    })
})
</script>
<?php include_once('./includes/_footer.php'); ?>
