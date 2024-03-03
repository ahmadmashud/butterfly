$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'prices/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            $('[name=type]').val(data.type);
            $('[name=nilai]').val(data.nilai);
            $('[name=satuan]').val(data.satuan).prop('selected', true);
            $('#editModal').modal('show');

        },
        error: function (err) {
            debugger;
        }
    });
});
