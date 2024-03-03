$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'rooms/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            $('[name=no]').val(data.no);
            if (!data.is_used) {
                $('[name=is_used]').prop('checked', true);
            }
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
