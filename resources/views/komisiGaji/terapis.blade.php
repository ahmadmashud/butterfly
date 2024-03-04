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
            <form action="/komisi_gaji/terapis/{{$id}}">
                <div class="form-inline" style="font-size: 17px;">
                    <label class="sr-only">Tanggal Awal</label>
                    <input required name="tanggal_awal" class="form-control mb-2 mr-sm-2 mb-sm-0" type="date" placeholder="Tanggal awal" value="{{@$tanggal_awal}}">
                    <label class="sr-only">Tanggal Akhir</label>
                    <input required name="tanggal_akhir" class="form-control mb-2 mr-sm-2 mb-sm-0" type="date" placeholder="Tanggal akhir" value="{{@$tanggal_akhir}}">
                </div>
                <br>
                <div class="text-left">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <!-- <button class="btn btn-success" type="submit">Print Excel</button> -->
                    <a class="btn btn-secondary" href="/komisi_gaji/terapis/{{$id}}">Reset</a>
                    <a class="btn btn-danger" href="/komisi_gaji/terapis">Kembali</a>
                </div>
            </form>
        </div>
    </div>
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title"></div>
            <div class="d-flex justify-content-end">
            </div>
        </div>
        <div class="ibox-body">
            <table class="table table-striped table-bordered" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Total Sesi</th>
                        <th>Fee Sesi</th>
                        <th>Komisi Terapis</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ HelperCustom::formatDate($value['tanggal']) }}</td>
                        <td>{{ $value['nama'] }}</td>
                        <td>{{ $value['nama_paket'] }}</td>
                        <td>{{ $value['sesi'] }}</td>
                        <td>@convert($value['fee_sesi'])</td>
                        <td>@convert($value['komisi_terapis'])</td>
                        <td>@convert($value['total'])</td>
                        <td><button data-tanggal="{{ HelperCustom::formatDate($value['tanggal']) }}" data-terapis="{{ $value->nama}}"  data-id="{{ $value->ids}}" type="button" class="produk btn btn-primary">Produk</button></td>
                        <!-- <td><a href="/komisi_gaji/terapis/produk?ids={{ $value->ids}}" class="btn btn-primary">Produk view</span></a></td> -->
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="8" class="text-center"><b>Total</b></td>
                    <td><b>@convert($total)</b></td>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- MODAL -->
@include('komisiGaji._terapis_produk')
@endsection


@section('extra_javascript')
<script src="{{ asset('assets/js/komisiGaji/terapis.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/js/komisiGaji/terapis_produk.js') }}" type="text/javascript"> </script>
@endsection