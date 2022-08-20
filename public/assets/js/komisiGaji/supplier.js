$(document).on('click', '#bntPrint', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'komisi_gaji/supplier/print/rekap?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});