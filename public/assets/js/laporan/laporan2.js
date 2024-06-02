$(document).on('click', '#bntPrint', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'laporan/r/print/pdf/v2?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});


$(document).on('click', '.check', function (e) {
    
    var id = $(this).val();

    if (this.checked == false) {
        var id = $(this).val();
        $(`<input class="form-control" name="id_delete[]" type="hidden" value="` + id + `" readonly   />`)
            .appendTo('#form')
    } else {
        $('[name="id_delete[]"]').each(function () {
            var idList = $(this).val();
            if(idList == id){
                $(this).remove();
            }
        })
    }
});
