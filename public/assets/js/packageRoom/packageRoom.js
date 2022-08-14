$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'packageRooms/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            $('[name=nama]').val(data.nama);
            $('[name=harga]').val(data.harga);
            $('[name=km_supplier]').val(data.km_supplier);
            $('[name=km_terapis]').val(data.km_terapis);
            $('#editModal').modal('show');
            if (data.is_active) {
                $('[name=is_active]').bootstrapToggle('on');
            }else{
                $('[name=is_active]').bootstrapToggle('off');
            }


        },
        error: function (err) {
            debugger;
        }
    });
});
