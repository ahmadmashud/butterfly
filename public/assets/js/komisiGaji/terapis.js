$(document).on('click', '#btnPrintSummary', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'komisi_gaji/terapis/print/rekap?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
}); 

$(document).on('click', '#btnPrintDetail', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'komisi_gaji/terapis/print/product?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
}); 