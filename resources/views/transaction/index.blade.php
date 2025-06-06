@extends('layouts.main')

@section('title',$title)

@section('breadcumb',$title)

@section('content')
<style>
    .loker-container{
        background-color: unset;
        margin-top:120px;    
        width: 220px;
        min-height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }
    .blink {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
<div class="page-heading">
    <!-- <h3 class="page-title" style="text-align: center;">Daftar {{$title}}</h3> -->
    <div class="d-flex justify-content-end" style="margin-top: 10px;">
        <a class="btn btn-primary" href="/transactions/add">
            Tambah Transaksi
        </a>
    </div>
</div>
<div class="page-content fade-in-up">

    <div class="col-md-3 loker-container" >
        <div class="ibox">

            <div class="ibox-body">
                <div class="row">
                    <div class="col-sm-12" style="text-align:center;">
                        <h3 style="color:white">LOKER</h3>
                    </div>

                    @foreach($lokers as $key => $value)
                    <div id="loker{{$value->id}}" class="col-sm-3 {{ $value->is_used ? 'used' : 'unused' }}" style="border-style: solid;border-color: black;text-align: center;">
                        {{$value->no}}
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-left: 200px;">
        @foreach($data as $key => $value)
        <div class="col-md-4" >
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
                            <input data-id_loker ="{{$value->id_loker}}" style="background-color: red;color:white;" data-countdown="{{ $value->status == 'ACCEPTED' ? $value->tanggal_keluar : null }}" class="form-control" type="text" readonly>
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
                            <input value="@convert($value->amount_harga_produk)" class="form-control amount" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        @if($value->status == 'ACCEPTED')
                        <div class="col-sm-4 form-group right text-right">
                        @if (HelperCustom::isExistsAccess('TRX_CANCEL'))    
                            <form method="post" action="/transactions/cancel/{{$value->id}}">
                                @csrf
                                <button class="btn btn-warning" type="submit">CANCEL</button>
                            </form>
                        @endif
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
                        <div class="col-sm-4 form-group right text-right">
                        </div>
                        <div class="col-sm-5 form-group right text-right">
                            <button class="btn btn-primary btnPayment" type="button" data-id="{{$value->id}}">PEMBAYARAN</button>
                        </div>
                        <div class="col-sm-3 form-group right text-right">
                            <a href="/transactions/edit/{{$value->id}}" class="btn btn-success" type="submit">EDIT</a>
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