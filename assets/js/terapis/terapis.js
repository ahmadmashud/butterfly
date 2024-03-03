$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'terapis/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            $('[name=nama]').val(data.nama);
            $('[name=code]').val(data.code);
            $('[name=tanggal_join]').val(data.tanggal_join);
            $('[name=status]').val(data.status);
            if (data.is_active) {
                $('[name=is_active]').bootstrapToggle('on');
            }else{
                $('[name=is_active]').bootstrapToggle('off');
            }


            $('#editModal').modal('show');

        },
        error: function (err) {
            debugger;
        }
    });
});
