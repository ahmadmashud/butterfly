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