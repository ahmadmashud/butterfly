@extends('layouts.main')

@section('title',$title)

@section('breadcumb',$title)

@section('content')

<div class="page-heading">
    <!-- <h3 class="page-title" style="text-align: center;">Daftar {{$title}}</h3> -->
    <div class="d-flex justify-content-end" style="margin-top: 10px;">
        <a class="btn btn-primary" href="/transactions/add">
            Tambah Transaksi
        </a>
    </div>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-2" style="position: relative;">
            <div class="ibox">

                <div class="ibox-body">
                    <div class="row">
                        <div class="col-sm-12" style="text-align:center;">
                            <h3>LOKER</h3>
                        </div>

                        @foreach($lokers as $key => $value)
                        <div class="col-sm-3 {{ $value->is_used ? 'used' : '' }}" style="border-style: solid;border-color: black;text-align: center;">
                            {{$value->no}}
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        @foreach($data as $key => $value)
        <div class="col-md-3" style="position: relative; ">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title text-center">LOKER : {{$value->loker->no}}</div>
                </div>
                <div class="ibox-body">
                    <!-- <form> -->
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>ID: </label>
                        </div>
                        <div class="col-sm-9 form-group">
                            <input class="form-control" type="text" value="{{$value->trx_no}}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Pelanggan: </label>
                        </div>
                        <div class="col-sm-9 form-group">
                            <input class="form-control" type="text" value="{{$value->nama_pelanggan}}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Room: </label>
                        </div>
                        <div class="col-sm-9 form-group">
                            <input class="form-control" value="{{$value->room->no}}" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Tanggal: </label>
                        </div>
                        <div class="col-sm-9 form-group">
                            <input class="form-control" value="{{$value->tanggal_masuk}}" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Durasi: </label>
                        </div>
                        <div class="col-sm-4 form-group">
                            <input value="{{$value->jumlah_sesi}}" class="form-control" type="text" readonly>
                        </div>
                        <div class="col-sm-5 form-group">
                            <input style="background-color: red;color:white;" data-countdown="{{ $value->status == 'ACCEPTED' ? $value->tanggal_keluar : null }}" class="form-control" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Paket: </label>
                        </div>
                        <div class="col-sm-4 form-group">
                            <input style="font-size: 12px;" value="{{$value->paket->nama}}" class="form-control" type="text" readonly>
                        </div>
                        <div class="col-sm-5 form-group">
                            <input value="@convert($value->paket->harga)" class="form-control amount" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>F&D: </label>
                        </div>
                        <div class="col-sm-9 form-group">
                            <input value="@convert($value->amount_total_fnd)" class="form-control amount" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Terapis: </label>
                        </div>
                        <div class="col-sm-4 form-group">
                            <input style="font-size: 12px;" value="{{$value->terapis->code}}" class="form-control" type="text" readonly>
                        </div>
                        <div class="col-sm-5 form-group">
                            <input value="{{$value->terapis->nama}}" class="form-control" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Produk: </label>
                        </div>
                        <div class="col-sm-9 form-group">
                            <input value="@convert($value->produk->harga)" class="form-control amount" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        @if($value->status == 'ACCEPTED')
                        <div class="col-sm-4 form-group right text-right">
                            <form method="post" action="/transactions/cancel/{{$value->id}}">
                                @csrf
                                <button class="btn btn-warning" type="submit">CANCEL</button>
                            </form>
                        </div>
                        <div class="col-sm-4 form-group right text-center">
                            <form method="post" action="/transactions/stop/{{$value->id}}">
                                @csrf
                                <button class="btn btn-danger" type="submit">STOP</button>
                            </form>
                        </div>
                        <div class="col-sm-4 form-group right text-left">
                            <a href="/transactions/edit/{{$value->id}}" class="btn btn-success" type="submit">EDIT</a>
                        </div>
                        @elseif($value->status == 'FINISHED')
                        <div class="col-sm-12 form-group right text-center">
                            <button class="btn btn-primary btnPayment" type="button" data-id="{{$value->id}}">PEMBAYARAN</button>
                        </div>
                        @elseif($value->status == 'PAID')
                        -
                        @endif
                        <!-- <button class="btn btn-success" type="submit">EDIT</button> -->

                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

<!-- MODAL -->
@include('transaction._payment')
@endsection


@section('extra_javascript')
<script src="{{ asset('assets/js/transaction/transaction.js') }}" type="text/javascript"> </script>
@endsection