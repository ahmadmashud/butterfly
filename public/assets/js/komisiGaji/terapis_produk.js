$(document).on('click', '.produk', function (e) {
    var id = this.dataset.id;
    var terapis = this.dataset.terapis;
    var tanggal = this.dataset.tanggal;
    $.ajax({
        type: 'GET',
        url: base_url + 'komisi_gaji/terapis/produk?ids=' + id,
        success: function (data) {
            $('#table-produk tbody td').remove()
            var no  = 1;
            data = data[0]
            var total = 0;
            for(i = 0 ; i< data.length ; i++){
                total += data[i].total;
                $('#table-produk tbody')
                .append("<tr>")
                .append("<td>"+no+"</td>")
                .append("<td>"+data[i].nama+"</td>")
                .append("<td>"+data[i].qty+"</td>")
                .append("<td>"+formatMoney(data[i].harga)+"</td>")
                .append("<td>"+formatMoney(data[i].total)+"</td>")
                .append("</tr>")
                no++
            }
            $('#text-total').text(formatMoney(total));
            $('#text-terapis').text(terapis);
            $('#text-tanggal').text(tanggal);
            $('#produkModal').modal('show');

        },
        error: function (err) {
            debugger;
        }
    });
});
