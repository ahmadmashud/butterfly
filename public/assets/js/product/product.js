$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'products/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            $('[name=nama]').val(data.nama);
            $('[name=harga]').val(data.harga);
            $('[name=km_terapis]').val(data.km_terapis);
            $('[name=km_gro]').val(data.km_gro);
            $('[name=km_spv]').val(data.km_spv);
            $('[name=km_staff]').val(data.km_staff);
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
