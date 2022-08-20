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
    }

    .number {
        text-align: right;
    }

    .text {
        text-align: center;
    }
</style>

<body>
    <h1 style="text-align:center">Rekapitulasi Aroma Therapy</h1>
    <p style="text-align:center">{{HelperCustom::formatDate(@$tanggal_awal) }} s/d {{ HelperCustom::formatDate(@$tanggal_akhir) }}</p>

    <table id="customers">
        <thead>
            <tr>
                <th >No</th>
                <th>ID</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @foreach($data as $key => $value)
            <tr>
                @php $total = $total + $value['total'] @endphp
                <td class="text">{{ $loop->index + 1 }}</td>
                <td class="text">{{ $value['code'] }}</td>
                <td class="text">{{ $value['nama'] }}</td>
                <td class="number">@convert($value['harga'])</td>
                <td class="text">{{ $value['qty'] }}</td>
                <td class="number">@convert($value['total'])</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td style="background-color: unset;border:none" class="text" colspan="5"></td>
            <td class="number">@convert($total)</td>
        </tfoot>
    </table>

</body>

</html>