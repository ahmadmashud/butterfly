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
            <form id="formFilter" action="/komisi_gaji/user">
                <div class="form-inline" style="font-size: 17px;">
                    <label class="sr-only">Tanggal Awal</label>
                    <input required name="tanggal_awal" class="form-control mb-2 mr-sm-2 mb-sm-0" type="date" placeholder="Tanggal awal" value="{{@$tanggal_awal}}">
                    <label class="sr-only">Tanggal Akhir</label>
                    <input required name="tanggal_akhir" class="form-control mb-2 mr-sm-2 mb-sm-0" type="date" placeholder="Tanggal akhir" value="{{@$tanggal_akhir}}">
                </div>
                <br>
                <div class="text-left">
                    <button class="btn btn-primary"  type="submit">Cari</button>
                    <button class="btn btn-success" id="bntPrint" type="button">Print</button>
                    <a class="btn btn-secondary" href="/komisi_gaji/user">Reset</a>
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
                        <th>Qty</th>
                        <th>Komisi Sales</th>
                        <th>Komisi Manager</th>
                        <th>Komisi All Staff</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total_qty = 0 @endphp
                    @php $total_gro = 0 @endphphp
                    @php $total_manager = 0 @endphp
                    @php $total_staff = 0 @endphp
                    @foreach($data as $key => $value)
                    <tr>
                        @php $total_qty = $total_qty + $value['qty'] @endphp
                        @php $total_gro = $total_gro + $value['gro'] @endphp
                        @php $total_manager = $total_manager + $value['manager'] @endphp
                        @php $total_staff = $total_staff + $value['staff'] @endphp

                        <td class="text">{{ $loop->index + 1 }}</td>
                        <td class="text">{{ $value['code'] }}</td>
                        <td class="text">{{ $value['sales'] }}</td>
                        <td class="text">{{ $value['qty'] }}</td>
                        <td class="number">@convert($value['gro'])</td>
                        <td class="number">@convert($value['manager'])</td>
                        <td class="number">@convert($value['staff'])</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="text" colspan="3"></td>
                        <td class="text">{{$total_qty}}</td>
                        <td class="number">@convert($total_gro)</td>
                        <td class="number">@convert($total_manager)</td>
                        <td class="number">@convert($total_staff)</td>
                    </tr>
                </tbody>
                <tfoot>
                    <td class="text" colspan="4"></td>
                    <td class="number">Total Komisi</td>
                    <td class="number">@convert($total_gro + $total_manager + $total_staff)</td>
                    <td class="number"></td>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- MODAL -->
@endsection


@section('extra_javascript')
<script src="{{ asset('assets/js/komisiGaji/user.js') }}" type="text/javascript"> </script>
@endsection