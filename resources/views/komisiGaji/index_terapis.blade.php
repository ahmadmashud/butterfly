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
            <form id="formFilter" action="/komisi_gaji/terapis/print">
                <div class="form-inline" style="font-size: 17px;">
                    <label class="sr-only">Tanggal Awal</label>
                    <input required name="tanggal_awal" class="form-control mb-2 mr-sm-2 mb-sm-0" type="date" placeholder="Tanggal awal" value="{{@$tanggal_awal}}">
                    <label class="sr-only">Tanggal Akhir</label>
                    <input required name="tanggal_akhir" class="form-control mb-2 mr-sm-2 mb-sm-0" type="date" placeholder="Tanggal akhir" value="{{@$tanggal_akhir}}">
                </div>
                <br>
                <div class="text-left">
                    <!-- <button class="btn btn-primary" type="submit">Cari</button> -->
                    <button class="btn btn-success" id="btnPrintSummary" type="button">Print Summary</button>
                    <button class="btn btn-success" id="btnPrintDetail" type="button">Print Produk</button>
                    <a class="btn btn-secondary" href="/komisi_gaji/terapis/">Reset</a>
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
                        <th>ID</th>
                        <th>Nama</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $value['code'] }}</td>
                        <td>{{ $value['nama'] }}</td>
                        <td><a href="/komisi_gaji/terapis/{{ $value->id}}" class="btn btn-primary">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL -->
@endsection


@section('extra_javascript')
<script src="{{ asset('assets/js/komisiGaji/terapis.js') }}" type="text/javascript"> </script>
@endsection