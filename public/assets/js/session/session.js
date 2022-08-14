$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'sessions/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            $('[name=waktu_per_sesi]').val(data.waktu_per_sesi);
            $('[name=minimum_sesi]').val(data.minimum_sesi);
            $('[name=harga]').val(data.harga);
            $('[name=discount]').val(data.discount * 100);
            $('[name=discount_sesi_ke]').val(data.discount_sesi_ke);

            $('#editModal').modal('show');

        },
        error: function (err) {
            debugger;
        }
    });
});
