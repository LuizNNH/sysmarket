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
    var name = button.data('name')
    var id = button.data('id')
    var modal = $(this)
    modal.find('#inptCategoryNm').val(name)
    modal.find('#inptCategoryId').val(id)
})

$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('name')
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-title').text('Você deseja apagar ' + recipient + '?')
    modal.find('#deleteInput').val(id)
})

