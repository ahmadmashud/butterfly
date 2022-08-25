// ============== ADD TRX
$("#form").each(function () {
    var currentForm = $(this);

    $(this).validate({
        rules: {
            loker: "required",
            nama_pelanggan: "required",
            room: "required",
            date: "required",
            durasi: "required",
            paket: "required",
            terapis: "required",
            id_sales: "required"
        },
        submitHandler: function (form) {
            // $('#loading').show();
            var grand_total = accounting.unformat($('[name=grand_total]').val());
            if (grand_total == 0) {
                alert('Grand Total Tidak valid (0), coba ubah2 paket untuk memastikan total terkalkulasi atau refresh halaman');
                return;
            }
            submit();
        }
    });
});


//================ HANDLING FND
$(document).on('click', '#btn_modal_fnd', function (e) {
    $('#form_modal_fnd input').val('');
    $('[name=fnd]').val('');
});

var total_all_fnd = 0;
var selectedFnd = new Map();

$(document).on('click', '#add_fnd', function (e) {
    var qty = Number($('[name=qty_fnd]').val());
    if (qty == null || qty == '' || qty == 0) {
        alert('Qty wajib diisi');
        return;
    }
    var stock = Number($('[name=stock_fnd]').val());
    if (qty > stock) {
        alert('Stock tidak cukup');
        return;
    }
    var nama = $('[name=fnd] :selected').text();
    var id_fnd = $('[name=fnd] :selected').val();
    var price = $('[name=price_fnd]').val()
    var total = unformatMoney(price) * unformatMoney(qty);
    total_all_fnd = total_all_fnd + total;

    if (selectedFnd.has(id_fnd)) {
        var qtyBefore = selectedFnd.get(id_fnd);
        selectedFnd.set(id_fnd, qty + qtyBefore)
    } else {
        selectedFnd.set(id_fnd, qty);
    }

    $('[name=total_fnd]').val(formatMoney(total_all_fnd));

    $(`<div class="col-sm-5 form-group">
    <input class="form-control" type="text" value="` + nama + `" readonly>
    <input name="id_fnd[]"  class="form-control" type="hidden" value="` + id_fnd + `" readonly>
    </div>
    <div class="col-sm-3 form-group">
    <input name="qty[]"  class="form-control" type="number" value="` + qty + `" readonly>
    </div>
    <div class="col-sm-4 form-group">
    <input name="price[]"  class="form-control amount" type="text" value="` + price + `" readonly>
    </div>`)
        .appendTo('#fnd_form')

    $('#fnd_modal').modal('hide');

    calculateTotal();
});


$(document).on('click', '#btn_reset_fnd', function (e) {
    $('#fnd_form').children().remove();
    total_all_fnd = 0;
    $('[name=total_fnd]').val(0);
    selectedFnd = new Map();
    calculateTotal();
});


// MODAL F&D
$(document).on('change', '[name=fnd]', function (e) {
    var id = this.value;
    $.ajax({
        type: 'GET',
        url: base_url + 'foodDrinks/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=price_fnd]').val(formatMoney(data.harga));
            var qty = selectedFnd.get(id) == undefined ? 0 : selectedFnd.get(id);
            $('[name=stock_fnd]').val(data.stock - qty);
            calculateTotal();
        },
        error: function (err) {
            debugger;
        }
    });
});
//================ END HANDLING FND

// MAIN TRX ADD

$(document).on('change', '[name=paket]', function (e) {
    var id = this.value;
    $.ajax({
        type: 'GET',
        url: base_url + 'packageRooms/' + id,
        success: function (data) {
            var data = data.data;
            $('[name=total_harga_room]').val(formatMoney(data.harga));
            $('[name=harga_room]').val(formatMoney(data.harga));
            calculateDiskon();
            calculateTotal();
        },
        error: function (err) {
            debugger;
        }
    });
});

$(document).on('change', '[name=jumlah_sesi]', function (e) {
    var waktu_per_sesi = $('[name=waktu_per_sesi]').val();
    var jumlah_sesi = this.value;
    var durasi = jumlah_sesi * waktu_per_sesi;
    $('[name=durasi]').val(durasi);
    calculateTotal();
});

$(document).on('keyup', '[name=total_discount]', function (e) {
    calculateTotal();
});

function calculateDiskon() {
    var harga_room = unformatMoney($('[name=harga_room]').val());
    var diskon = unformatMoney($('[name=discount]').val());
    var diskon_sesi_ke = unformatMoney($('[name=discount_sesi_ke]').val());
    var harga_ketentuan_diskon = harga_room * diskon_sesi_ke; //harga room * diskon di sesi ke
    var total_diskon = ((harga_ketentuan_diskon * diskon) / 100);
    $('[name=total_discount]').val(formatMoney(total_diskon));
}


function calculateTotal() {
    var total_diskon = unformatMoney($('[name=total_discount]').val());
    var jumlah_sesi = $('[name=jumlah_sesi]').val();
    var total_harga_room = unformatMoney($('[name=harga_room]').val()) * (jumlah_sesi) - total_diskon;
    // var total_harga_produk = unformatMoney($('[name=total_harga_produk]').val());
    var total_harga_produk = getTotalProduk();
    var total_fnd = unformatMoney($('[name=total_fnd]').val());
    var total = total_harga_room + total_harga_produk + total_fnd;
    var service_charge = unformatMoney($('[name=service_charge]').val());
    var total_service_charge = (total * service_charge) / 100;
    var grand_total = total + total_service_charge;

    $('[name=total]').val(formatMoney(total));
    $('[name=total_service_charge]').val(formatMoney(total_service_charge));
    $('[name=total_harga_room]').val(formatMoney(total_harga_room));
    $('[name=grand_total]').val(formatMoney(grand_total));
}

// ============== INDEX TRX

$('[data-countdown]').each(function () {
    var $this = $(this),
        finalDate = $(this).data('countdown'),
        id_loker = $(this).data('id_loker');
    $this.countdown(finalDate, function (event) {
        $this.val(event.strftime('%H:%M:%S'));
        if (event.offset.hours == 0 && event.offset.minutes <= 9 && event.offset.seconds > 0) {
            $('#loker' + id_loker).addClass("blink");
        } else if (event.offset.hours == 0 && event.offset.minutes == 0 && event.offset.seconds == 0) {
            $('#loker' + id_loker).removeClass("blink");
            $('#loker' + id_loker).removeClass("used");
            $('#loker' + id_loker).addClass("unused");
        }
    })
    // .on('finish.countdown', function() { callback
    //     $(this).hide();
    // });
});


// ============== PAYMENT
$("#form_payment").each(function () {
    var currentForm = $(this);

    $(this).validate({
        rules: {
            metode_pembayaran: "required",
            cash: "required",
            credit: "required",
            nama: "required"
        },
        submitHandler: function (form) {
            var totalPaid = Number(cash.value) + Number(credit.value);
            var total = accounting.unformat($('[name=total]').val());
            var metode_pembayaran = $('[name=metode_pembayaran]').val();
            if (totalPaid < total && (metode_pembayaran != 'FOC' && metode_pembayaran != 'CANCEL')) {
                alert('Pembayaran Kurang dari Total Tagihan');
                return
            }
            submit();
        }
    });
});

$(document).on('keyup', '.calculate_kembalian', function (e) {
    var totalTagihan = accounting.unformat($('[name=total]').val());
    var totalCash = accounting.unformat($('[name=cash]').val());
    var totalCredit = accounting.unformat($('[name=credit]').val());
    var kembalian = (totalCash + totalCredit) - totalTagihan;
    if (kembalian < 0) {
        kembalian = 0;
    }
    $('[name=kembalian]').val(formatMoney(kembalian));

});


$(document).on('change', '[name=metode_pembayaran]', function (e) {
    if (this.value == 'CASH') {
        $('#m_cash').show();
        $('#m_credit').hide();
        $('#m_nama').hide();
        $('#m_no_rek').hide();
        $('#m_kembalian').show();
    } else if (this.value == 'CREDIT') {
        $('#m_cash').hide();
        $('#m_credit').show();
        $('#m_nama').show();
        $('#m_no_rek').show();
        $('#m_kembalian').show();
    } else if (this.value == 'CASH_CREDIT') {
        $('#m_cash').show();
        $('#m_credit').show();
        $('#m_nama').show();
        $('#m_no_rek').show();
        $('#m_kembalian').show();
    } else {
        $('#m_cash').hide();
        $('#m_credit').hide();
        $('#m_nama').hide();
        $('#m_no_rek').hide();
        $('#m_kembalian').hide();
    }
});

$(document).on('click', '.btnPayment', function (e) {
    var id = this.dataset.id;
    $.ajax({
        type: 'GET',
        url: base_url + 'transactions/' + id,
        success: function (data) {
            var data = data.data;
            $('#exampleModalLabel').text('LOKER ' + data.loker.no);
            $('#id').val(data.id);
            $('#order_id').val(data.trx_no);
            $('#nama_pelanggan').val(data.nama_pelanggan);
            $('#room').val(data.room.no);
            $('#tanggal').val(data.tanggal);
            $('#durasi').val(data.durasi);
            $('#jumlah_sesi').val(data.jumlah_sesi);
            $('#paket').val(data.paket.nama);
            $('#terapis').val(data.terapis.nama);
            $('#id_terapis').val(data.terapis.code);
            $('#harga_paket_info').val(formatMoney(data.amount_harga_paket));
            $('#harga_paket').val(formatMoney(data.amount_harga_paket));
            $('#harga_paket_setelah_diskon').val(formatMoney(data.amount_harga_paket_setelah_diskon));
            $('#amount_total_fnd').val(formatMoney(data.amount_total_fnd));
            $('#produk').val(formatMoney(data.amount_harga_produk));
            $('#total_diskon').val(formatMoney(data.amount_total_discount));
            $('#service_charge').val(formatMoney(data.amount_total_service_charge));
            $('#total').val(formatMoney(data.amount_grand_total));

            // reset modal
            $('#payment').find('input,select').val('');
            $('[name=metode_pembayaran]').change();
            $('#paymentModal').modal('show');

        },
        error: function (err) {
            console.log(err);
        }
    });
});


/// HANDLING ADD PRODUK

$(document).on('change', '[name=produk]', function (e) {
    var id = this.value;
    $.ajax({
        type: 'GET',
        url: base_url + 'products/' + id,
        success: function (data) {
            var data = data.data;
            // $('[name=total_harga_produk]').val(formatMoney(data.harga));
            $('[name=produk]').attr('harga', data.harga);
        },
        error: function (err) {
            debugger;
        }
    });
});

$(document).on('click', '#add_produk', function (e) {
    var id_produk = $('[name=produk]').val();
    var isHasSelected = $("[name='id_produk[]']").map(function () {
        return this.value == id_produk;
    })[0];

    if (id_produk == '') {
        alert('Pilih Produk!');
        return;
    }

    if (isHasSelected) {
        alert('Produk sudah dipilih!');
        return;
    }
    var nama = $('[name=produk] :selected').text();
    var harga = $('[name=produk]').attr('harga');
    $(`<div class="col-sm-6 form-group">
    <input class="form-control" type="text" value="` + nama + `" readonly>
    <input name="id_produk[]"  class="form-control" type="hidden" value="` + id_produk + `" readonly>
    </div>
    <div class="col-sm-4 form-group">
    <input type="hidden" name="harga_produk[]" value="` + harga + `"  >
    <input min="1" name="qty_produk[]" value="1"  class="qty_produk form-control" type="number"  >
    </div>`)
        .appendTo('#produk_form');
    calculateTotal();
});


$(document).on('change', '.qty_produk', function (e) {
    calculateTotal();
});

$(document).on('click', '#btn_reset_produk', function (e) {
    $('#produk_form').children().remove();
    calculateTotal();
});


function getTotalProduk() {
    var produk_size = $('[name="id_produk[]"]').length;
    var total = 0;
    var harga = $('[name="harga_produk[]"]');
    var qty = $('[name="qty_produk[]"]');
    for (let index = 0; index < produk_size; index++) {
        total = total + harga[index].value * qty[index].value;
    }
    $('[name=total_harga_produk]').val(formatMoney(total));
    return total;
}
