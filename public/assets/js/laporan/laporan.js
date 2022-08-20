$(document).on('click', '#bntPrintExcel', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'laporan/print/excel?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});

$(document).on('click', '#bntPrintPdf', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'laporan/print/pdf?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});

$(document).on('click', '#btnPrintFnd', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'laporan/print/fnd/excel?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});
$(document).on('click', '#btnPrintFndPdf', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'laporan/print/fnd/pdf?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});


$(document).on('click', '#btnPrintProductExcel', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'laporan/print/products/excel?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});

$(document).on('click', '#btnPrintProductPdf', function (e) {
    var a = document.createElement('a');
    a.href = base_url + 'laporan/print/products/pdf?' + $('#formFilter').serialize();
    a.target = '_blank';
    a.click();
});