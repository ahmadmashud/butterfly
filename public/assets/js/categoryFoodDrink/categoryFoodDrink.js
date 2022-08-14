$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'categoryFoodDrinks/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            $('[name=nama]').val(data.nama);


            $('#editModal').modal('show');

        },
        error: function (err) {
            debugger;
        }
    });
});
