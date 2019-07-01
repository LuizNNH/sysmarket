$(function () {
    $('#categoriesTable').DataTable({
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
    var recipient = button.data('whatever')
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body input').val(recipient)
})

$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('name')
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-title').text('Você deseja apagar ' + recipient + '?')
    modal.find('#deleteInput').val(id)
})

