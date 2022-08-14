@extends('layouts.main')

@section('title',$title)

@section('breadcumb',$title)

@section('content')

<div class="page-heading">
    <h1 class="page-title">{{$title}}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Daftar {{$title}}</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title"></div>
            <div class="d-flex justify-content-end">
                <!-- <button type="button" id="addModal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Baru
                </button> -->
            </div>
        </div>
        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $value->trx_no }}</td>
                        <td>{{$value->tanggal}}</td>
                        <td>@convert($value->amount_grand_total)</td>
                        <td>
                            <button class="btn btn-primary">Lihat Detail</button>
                        </td>
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
<!-- <script src="{{ asset('assets/js/transaction/transaction.js') }}" type="text/javascript"> </script> -->
@endsection