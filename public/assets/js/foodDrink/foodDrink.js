$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'foodDrinks/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            $('[name=nama]').val(data.nama);
            $('[name=harga]').val(data.harga);
            $('[name=stock]').val(data.stock);
            $('[name=id_category_food_drink]').val(data.id_category_food_drink).prop('selected', true);
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
