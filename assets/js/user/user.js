$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'users/' + id,
        success: function (data) {
            var data = data.data;
            var link = $('#base_url').val() + 'assets/uploads/delivery/';

            $('[name=id]').val(data.id);
            $('[name=nama]').val(data.nama);
            $('[name=username]').val(data.username);
            // $('[name=password]').val(data.password);
            $('[name=tanggal_join]').val(data.tanggal_join);
            $('[name=role_id]').val(data.role_id);
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
