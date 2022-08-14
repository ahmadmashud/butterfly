$(document).on('click', '#bntPrint', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'laporan/download?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});

$(document).on('click', '#btnPrintFnd', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'laporan/download/fnd?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});

