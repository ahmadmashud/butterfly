@extends('layouts.main')

@section('title',$title)

@section('breadcumb',$title)

@section('content')

<div class="page-heading">
    <h1 class="page-title">{{$title}}</h1>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <form id="formFilter" action="/laporan">
                <div class="form-inline" style="font-size: 17px;">
                    <label class="sr-only">Tanggal Awal</label>
                    <input required name="tanggal_awal" class="form-control mb-2 mr-sm-2 mb-sm-0" type="date" placeholder="Tanggal awal" value="{{@$tanggal_awal}}">
                    <label class="sr-only">Tanggal Akhir</label>
                    <input required name="tanggal_akhir" class="form-control mb-2 mr-sm-2 mb-sm-0" type="date" placeholder="Tanggal akhir" value="{{@$tanggal_akhir}}">

                    @foreach(config('constants.metode_pembayaran') as $key => $value)
                    <label>{{$value}}</label> &nbsp;
                    <input {{ in_array($key, isset($metode_pembayaran) ? $metode_pembayaran : array()) ? 'checked' : '' }} type="checkbox" class="custom-control" value="{{$key}}" name="metode_pembayaran[]">
                    @endforeach
                </div>
                <br>
                <div class="text-left">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <button id="bntPrint" class="btn btn-success" type="button">Print</button>
                    <a class="btn btn-secondary" href="/laporan">Reset</a>
                </div>
            </form>
        </div>
    </div>
    <form id="form" action="/laporan/r" method="POST">
        @csrf
        <div class="ibox">
            <div class="ibox-head">
                <div class="text-left">
                    <button class="btn btn-primary text-left" >Simpan</button>
                </div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bordered" id="example-table-fixed-column-scrollx" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <td>
                                <!-- <input type="checkbox" id="checkAll"> -->
                            </td>
                            <th>No</th>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Loker</th>
                            <th>Terapis</th>
                            <th>Paket</th>
                            <th>Room</th>
                            <th>Sesi</th>
                            <th>Diskon</th>
                            <th>Room Terdiskon</th>
                            <th>Produk</th>
                            <th>F&D</th>
                            <th>Total</th>
                            <th>Service Charge</th>
                            <th>Grand Total</th>
                            <th>Pajak</th>
                            <th>Jenis Pembayaran</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $value)
                        <tr>
                            <td><input {{ $value->transaction2 != null ? 'checked' : '' }} class="check" type="checkbox" name="id[]" value="{{ $value->id}}" id-data="{{ $value->id}}"></td>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $value->trx_no }}</td>
                            <td>{{ HelperCustom::formatDateTime($value->tanggal_masuk) }}</td>
                            <td>{{ $value->loker->no }}</td>
                            <td>{{ $value->terapis->nama }}</td>
                            <td>{{ $value->paket->nama }}</td>
                            <td>@convert($value->amount_harga_paket)</td>
                            <td>{{ $value->jumlah_sesi }}</td>
                            <td>@convert($value->amount_total_discount)</td>
                            <td>@convert($value->amount_harga_paket_setelah_diskon)</td>
                            <td>@convert($value->amount_harga_produk)</td>
                            <td>@convert($value->amount_total_fnd)</td>
                            <td>@convert($value->amount_total)</td>
                            <td>@convert($value->amount_total_service_charge)</td>
                            <td>@convert($value->amount_grand_total)</td>
                            <td>@convert($value->amount_total_pajak)</td>
                            <td>{{ $value->payment != null ? config('constants.metode_pembayaran')[$value->payment->metode_pembayaran] : '-'}}</td>
                            <td>
                            <a href="/laporan/transaction/{{ $value->id }}/pdf" target="_blank" class="btn btn-success"><span class="fa fa-print"></span></a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

<!-- MODAL -->
@endsection


@section('extra_javascript')
<script src="{{ asset('assets/js/laporan/laporan2.js') }}" type="text/javascript"> </script>
@endsection