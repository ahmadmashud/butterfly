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
        font-weight: bold;
    }

    .number {
        text-align: right;
    }

    .text {
        text-align: center;
    }
</style>

<body>
    <h1 style="text-align:center">Komisi Aroma Therapy</h1>
    <p style="text-align:center">{{HelperCustom::formatDate(@$tanggal_awal) }} s/d {{ HelperCustom::formatDate(@$tanggal_akhir) }}</p>

    <table id="customers">
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
        </tbody>
        <tfoot>
            <td style="background-color: unset;border:none" class="text" colspan="3"></td>
            <td class="text">{{$total_qty}}</td>
            <td class="number">@convert($total_gro)</td>
            <td class="number">@convert($total_manager)</td>
            <td class="number">@convert($total_staff)</td>
        </tfoot>
        <tfoot>
            <td style="background-color: unset;border:none" class="text" colspan="4"></td>
            <td class="number">Total Komisi</td>
            <td class="number">@convert($total_gro + $total_manager + $total_staff)</td>
            <td class="number"></td>
        </tfoot>
    </table>
    <br>
</body>

</html>