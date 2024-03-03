$(document).on('click', '.edit', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'roles/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            $('[name=nama]').val(data.nama);
            $('[name=code]').val(data.code);
            if (data.is_default) {
                $('[name=code]').prop('readonly', true);
            }

            $('#editModal').modal('show');

        },
        error: function (err) {
            debugger;
        }
    });
});

$(document).on('click', '.setting_akses', function (e) {
    $('[name="privilege[]"]').prop('checked', false)
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'roles/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=id]').val(data.id);
            var privileges = data.privilege.map(a => { return Number(a.id_privilege) });
            var elements = $('[name="privilege[]"]');
            $('#role_nama').text(data.nama);
            for (let index = 0; index < elements.length; index++) {
                if(privileges.includes(Number(elements[index].value))){
                    elements[index].checked = true;
                }
                
            }

            $('#settingModal').modal('show');

        },
        error: function (err) {
            debugger;
        }
    });
});

