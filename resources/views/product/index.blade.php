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
                <button type="button" id="addModal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Baru
                </button>
                <!-- <a class="btn btn-primary" href="/users/add">Tambah Baru</a> -->
            </div>
        </div>
        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Komisi Terapis</th>
                        <th>Komisi GRO</th>
                        <th>Komisi Spv</th>
                        <th>Komisi Staff</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $value->code }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>@convert($value->harga)</td>
                        <td>@convert($value->km_terapis)</td>
                        <td>@convert($value->km_gro)</td>
                        <td>@convert($value->km_spv)</td>
                        <td>@convert($value->km_staff)</td>
                        <td><input disabled type="checkbox" {{ $value->is_active ? "checked" : "" }} 
                        data-toggle="toggle" data-on="Aktif" 
                        data-off="Non Aktif" data-onstyle="success" 
                        data-offstyle="danger" data-size="sm" data-width="100" ></td>
                        <td>
                            <form action="/products/{{ $value->id }}/delete" method="post">
                                @csrf
                                <button data-id="{{ $value->id }}" type="button" class="edit btn btn-success">Edit</button>
                                <!-- <button class="btn btn-danger">Hapus</button> -->
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL -->
@include('product._add')
@include('product._edit')
@endsection


@section('extra_javascript')
<script src="{{ asset('assets/js/product/product.js') }}" type="text/javascript"> </script>
@endsection