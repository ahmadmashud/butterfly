<!DOCTYPE html>
<html>

<head>
    <title>Butterfly Message</title>
</head>
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 12px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #D9D9D9;
        color: black;
    }

    #customers tfoot {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #D9D9D9;
        color: black;
        font-weight: bold;
    }

    .number {
        text-align: right;
    }

    .text {
        text-align: center;
    }

    @page {
        margin: 10px;
    }

    body {
        margin: 10px;
    }
</style>

<body>
    <h1 style="text-align:center">Payment Report</h1>
    <p style="text-align:center">{{HelperCustom::formatDate(@$tanggal_awal) }} s/d {{ HelperCustom::formatDate(@$tanggal_akhir) }}</p>

    <table id="customers">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Room</th>
                <th>Menu</th>
                <th>AT</th>
                <th>Diskon</th>
                <th>Total</th>
                <th>Jenis Pembayaran</th>
                <!-- <th>Kasir</th> -->
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @foreach($data as $key => $value)
            <tr>
                @php $total = $total + $value['amount_grand_total'] @endphp
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ HelperCustom::formatDateTime($value->tanggal_masuk) }}</td>
                <td>{{ $value->trx_no }}</td>
                <td>{{ $value->nama_pelanggan }}</td>
                <td>@convert($value->amount_harga_paket * $value->jumlah_sesi)</td>
                <td>@convert($value->amount_total_fnd)</td>
                <td>@convert($value->amount_harga_produk)</td>
                <td>@convert($value->amount_total_discount)</td>
                <td>@convert($value->amount_grand_total)</td>
                <td>{{ $value->payment != null ? config('constants.metode_pembayaran')[$value->payment->metode_pembayaran] : '-'}}</td>
                <!-- <td>{{ $value->sales->nama }}</td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table  id="customers" border="1" style="width: 60%;">
        <tr class="title">
            <th> <label>Total Cash</label></th>
            <td>@convert($total_cash) </td>

            <th> <label>Room Charge</label></th>
            <td>@convert($total_room) </td>

            <th> <label>Diskon</label></th>
            <td>@convert($total_diskon) </td>
            
            <th> <label>Fee Terapis</label></th>
            <td>@convert($total_fee_terapis) </td>
        </tr>
        <tr class="title">
            <th> <label>Total Credit</label></th>
            <td>@convert($total_credit) </td>

            <th> <label>Menu Charge</label></th>
            <td>@convert($total_fnd) </td>

            <th> <label>Tax</label></th>
            <td>@convert($total_tax) </td>
        </tr>
        <tr class="title">
            <th> <label>Total Foc</label></th>
            <td>@convert($total_foc) </td>

            <th> <label>Aroma Therapy</label></th>
            <td>@convert($total_harga_produk) </td>

            <th> <label>Service</label></th>
            <td>@convert($total_service) </td>
        </tr>
    </table>


</body>

</html>