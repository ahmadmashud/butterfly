<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document" style="max-width: 1100px">
        <div class="modal-content">
            <!-- FOR PAYMENT -->
            <form method="POST" action="/transactions/payment" id="form_payment" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="ibox">
                                <div class="ibox-body">
                                    <!-- <form> -->
                                    <div class="row">
                                        <div class="col-sm-4  form-group">
                                            <label>Order ID </label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="order_id" name="order_id" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>Pelanggan</label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="nama_pelanggan" name="nama_pelanggan" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>Room: </label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="room" name="room" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>Tanggal: </label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="tanggal" name="tanggal" class="form-control" type="date" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>Durasi: </label>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <input id="jumlah_sesi" name="jumlah_sesi" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <input id="durasi" name="durasi" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>Paket: </label>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <input id="paket" name="paket" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <input id="harga_paket_info" name="harga_paket_info" class="form-control amount" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>Terapis: </label>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <input id="id_terapis" name="id_terapis" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <input id="terapis" name="terapis" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="ibox">
                                <div class="ibox-head">
                                    <h4 class="ibox-title text-center">RINCIAN</h4>
                                </div>
                                <div class="ibox-body">
                                    <div class="row">
                                        <div class="col-sm-4  form-group">
                                            <label>Harga Paket </label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="harga_paket" name="harga_paket" class="form-control amount" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>Total Diskon: </label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="total_diskon" name="diskon" class="form-control amount" amount type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>Paket Terdiskon: </label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="harga_paket_setelah_diskon" name="harga_paket_setelah_diskon" class="form-control amount" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>Produk: </label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="produk" name="produk" class="form-control amount" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>F&D: </label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="amount_total_fnd" name="amount_total_fnd" class="form-control amount" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label>SC: </label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="service_charge" name="service_charge" class="form-control amount" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label><b>Total:</b></label>
                                        </div>
                                        <div class="col-sm-8 form-group">
                                            <input id="total" name="total" class="form-control amount" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="ibox">
                                <div class="ibox-head">
                                    <h4 class="ibox-title text-center">PEMBAYARAN</h4>
                                </div>
                                <div class="ibox-body">
                                    <!-- PAYMENT -->
                                    @csrf
                                    <input id="id" name="id" class="form-control" type="hidden">
                                    <div id="payment">
                                        <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label>Metode Bayar: </label>
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                <select id="metode_pembayaran" name="metode_pembayaran" class="form-control">
                                                    <option value="">------Pilih------</option>
                                                    @foreach(config('constants.metode_pembayaran') as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" id="m_credit" style="display: none;">
                                            <div class="col-sm-4 form-group">
                                                <label>Credit: </label>
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                <input id="credit" name="credit" class="form-control calculate_kembalian" type="text">
                                            </div>
                                        </div>
                                        <div class="row" id="m_cash" style="display: none;">
                                            <div class="col-sm-4 form-group">
                                                <label>Cash: </label>
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                <input id="cash" name="cash" class="form-control calculate_kembalian" type="text">
                                            </div>
                                        </div>
                                        <div class="row" id="m_nama" style="display: none;">
                                            <div class="col-sm-4 form-group">
                                                <label>Nama: </label>
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                <input id="nama" name="nama" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="row" id="m_no_rek" style="display: none;">
                                            <div class="col-sm-4 form-group">
                                                <label>No Ref: </label>
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                <input id="no_rek" name="no_rek" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div id="m_kembalian" class="row">
                                            <div class="col-sm-4 form-group">
                                                <label><b>Kembalian:</b></label>
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                <input readonly id="kembalian" name="kembalian" class="form-control amount" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>

            </form>
        </div>
    </div>
</div>