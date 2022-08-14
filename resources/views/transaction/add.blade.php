@extends('layouts.main')

@section('title',$title)

@section('breadcumb',$title)

@section('content')

<div class="page-heading">
</div>
<div class="page-content fade-in-up">
    <div class="row ibox">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="position: relative; ">
            <div class="ibox">
                <div class="ibox-body">
                    <h4 class="page-title" style="text-align: center;">Input {{$title}}</h4>
                    <!-- FORM -->
                    <!-- MASTER -->
                    <form id="form" action="/transactions/add" method="POST" autocomplete="off">
                        @csrf
                        <div class="row card-body">
                            <div class="col-sm-3 form-group">
                                <h4>Pilih Loker </h4>
                            </div>
                            <div class="col-sm-3 form-group">
                                <select name="loker" class="form-control" required>
                                    <option value="">Pilih Loker</option>
                                    @foreach( $lokers as $key => $value)
                                    <option value="{{$value->id}}">{{$value->no}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 card card-body">
                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Nama Pelanggan</label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input name="nama_pelanggan" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Room </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <select name="room" class="form-control" required>
                                            <option value="">Pilih Room</option>
                                            @foreach( $rooms as $key => $value)
                                            <option value="{{$value->id}}">{{$value->no}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Tanggal </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>Durasi </label>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <input name="jumlah_sesi" class="form-control" type="number" min="{{$session->minimum_sesi}}" value="{{$session->minimum_sesi}}">
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <input name="durasi" class="form-control" type="text" value="{{$session->minimum_sesi * $session->waktu_per_sesi}}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Paket </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <select name="paket" class="form-control" required>
                                            <option value="">Pilih Paket</option>
                                            @foreach( $packages as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Produk </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <select name="produk" class="form-control" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach( $products as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Terapis </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <select name="terapis" class="form-control" required>
                                            <option value="">Pilih Terapis</option>
                                            @foreach( $terapis as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Sales </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <select name="id_sales" class="form-control" required>
                                            <option value="">Pilih Sales</option>
                                            @foreach( $sales as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- TOTAL -->
                            <div class="col-sm-4  card card-body">
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <h4 class="text-center">TOTAL</h4>
                                    </div>
                                </div>
                                <div class="row" style="">
                                    <div class="col-sm-5 form-group">
                                        <label>Harga Per Paket </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input name="harga_room" class="form-control" type="text" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Diskon</label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input {{  !in_array('CHANGE_DISCOUNT_TRX', Session::get('privileges')) ? 'readonly' : '' }} name="total_discount" class="form-control" type="text" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Paket Terdiskon </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input name="total_harga_room" class="form-control" type="text" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Produk </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input name="total_harga_produk" class="form-control" type="text" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>F&D </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input name="total_fnd" class="form-control" type="text" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Total </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input name="total" class="form-control" type="text" value="0" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Service Charge</label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input name="total_service_charge" class="form-control" type="text" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <label>Grand Total </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input name="grand_total" class="form-control" type="text" value="0" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 form-group right text-right">
                                        <a class="btn btn-danger" href="/transactions">Batal</a>
                                        <button type="button" class="btn btn-secondary" onClick="window.location.reload()">
                                            Reset
                                        </button>
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>

                            <!-- F&D -->
                            <div class="col-sm-4 card card-body">
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <h4 class="text-center">F&D</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        Item
                                    </div>
                                    <div class="col-sm-4 form-group text-center">
                                        Qty
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        Harga
                                    </div>
                                </div>
                                <div class="row" id="fnd_form">

                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                    </div>
                                    <div class="col-sm-4 form-group text-right">
                                        TOTAL
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <input name="total_fnd" class="form-control" type="text" value="0" readonly>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col-sm-12 form-group">
                                        <button id="btn_reset_fnd" type="button" class="btn btn-danger">
                                            Reset
                                        </button>
                                        <button id="btn_modal_fnd" type="button" class="btn btn-primary" data-toggle="modal" data-target="#fnd_modal">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- PARAMETER HIDDEN -->
                        <input name="discount" class="form-control" type="hidden" value="{{ $session->minimum_sesi >= $session->discount_sesi_ke ? ($session->discount)*100 : 0 }}" readonly />

                        <input name="discount_sesi_ke" class="form-control" type="hidden" value="{{  $session->discount_sesi_ke }}" readonly>

                        <input name="waktu_per_sesi" class="form-control" type="hidden" value="{{  $session->waktu_per_sesi }}" readonly>

                        <input name="service_charge" class="form-control" type="hidden" value="{{ $prices->nilai }}" readonly>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
@include('transaction._add_fnd')
@endsection


@section('extra_javascript')
<script src="{{ asset('assets/js/transaction/transaction.js') }}" type="text/javascript"> </script>
@endsection