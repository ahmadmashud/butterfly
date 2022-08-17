@extends('layouts.main')

@section('title',$title)

@section('breadcumb',$title)

@section('content')

<div class="background-gray" style="position: fixed;width: 85%;border: 1px solid gray;">

    <div class="row">
        <div class="col-md-12 text-center">
            <div class="row">
                <div style="background-color: #00ff00;" class="col-md-2">
                    <h4>Available</h4>
                </div>
                <div style="background-color: #f742ff;" class="col-md-2">
                    <h4>Progressing</h4>
                </div>
                <div style="background-color: aqua;" class="col-md-2">
                    <h4>Finshing</h4>
                </div>
                <div style="background-color: blue;" class="col-md-2">
                    <h4>Resting</h4>
                </div>
                <div style="background-color: yellow;" class="col-md-2">
                    <h4>Book</h4>
                </div>
                <div style="background-color: white;" class="col-md-2">
                    <h4>Off</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="page-heading">
    <h1 class="page-title text-center">{{$title}}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="page-content fade-in-up" style="padding: 10px;">
    <div class="row d-flex justify-content-left">
        @foreach($data as $key => $value)
        <div class="col-sm-2 col-md-2 col-3" style="padding-right: 0px;padding-left: 0px;">
            <table border="1">
                <tr>
                    <th colspan="2">
                        <a href="galeri_detail.php">
                            <img class="img-fluid img-thumbnail" src="{{ asset('storage'.config('constants.file_folder_terapis').'/'.$value->foto) }}" style="width: 250px;height: 250px;padding: 0px;">
                    </th>
                </tr>
                <tr style="background-color: {{ config('constants.status_terapis_color')[$value->status] }}">
                    <th>
                        <div data-id="{{ $value->id_trx }}" style="text-align: center;width: 21px;" data-status="{{ $value->status }}" data-countdown="{{$value->tanggal_keluar}}">
                        {{$value->tanggal_keluar == null ? $value->code : ''}}
                        </div>
                    </th>
                    <th style="text-align: center;font-size: 15px;">
                        {{$value->nama}}
                    </th>
                </tr>
            </table>
        </div>
        @endforeach
    </div>
</div>


<!-- MODAL -->
@endsection


@section('extra_javascript')
<script src="{{ asset('assets/js/terapis/gallery.js') }}" type="text/javascript"> </script>
@endsection