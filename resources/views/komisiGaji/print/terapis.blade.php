<!DOCTYPE html>
<html>

<head>
    <title>Butterfly Message</title>
</head>
<style>
    .customers {
        font-size:14px;
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;
    }

    .customers td,
    .customers th {
        text-align: center;
        border: 1px solid #ddd;
        padding: 8px;
    }

    .customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .customers tr:hover {
        background-color: #ddd;
    }

    .customers th {
        text-align: center;
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #D9D9D9;
        color: black;
    }

    .customers tfoot {
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


    /* Add responsive column widths */
    th:nth-child(1),
    td:nth-child(1) { width: 10%; } /* No */
    
    th:nth-child(2),
    td:nth-child(2) { width: 20%; } /* ID Terapis */
    
    th:nth-child(3),
    td:nth-child(3) { width: 20%; } /* Nama */
    
    th:nth-child(4),
    td:nth-child(4) { width: 20%; } /* Paket */
    
    th:nth-child(5),
    td:nth-child(5) { width: 11%; } /* Total Sesi */
    
    th:nth-child(6),
    td:nth-child(6) { width: 11%; } /* Total Pdk */
    
    th:nth-child(7),
    td:nth-child(7) { width: 35%; } /* Fee Sesi */
    
    th:nth-child(8),
    td:nth-child(8) { width: 35%; } /* Komisi Produk */
    
    th:nth-child(9),
    td:nth-child(9) { width: 35%; } /* Total */
</style>

<body>
    <h1 style="text-align:center">Komisi & Gaji Terapis</h1>
    <p style="text-align:center">{{HelperCustom::formatDate(@$tanggal_awal) }} s/d {{ HelperCustom::formatDate(@$tanggal_akhir) }}</p>

    @php $grand_total_sesi = 0 @endphp
    @php $grand_qty_pdk = 0 @endphp
    @php $grand_total_fee_sesi = 0 @endphp
    @php $grand_total_komisi_terapis = 0 @endphp
    @php $grand_total = 0 @endphp
    @foreach($data as $key => $obj)
    <table class="customers">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Terapis</th>
                <th>Nama</th>
                <th>Paket</th>
                <th>Total Sesi</th>
                <th>Total Pdk</th>
                <th>Fee Sesi</th>
                <th>Komisi Produk</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total_sesi = 0 @endphp
            @php $total_pdk = 0 @endphp
            @php $total_fee_sesi = 0 @endphp
            @php $total_komisi_terapis = 0 @endphp
            @php $total = 0 @endphp
            @foreach($obj as $key => $value)
            <tr>
                @php $total_sesi = $total_sesi + $value['sesi'] @endphp
                @php $total_pdk = $total_pdk + $value['qty_pdk'] @endphp
                @php $total_fee_sesi = $total_fee_sesi + $value['fee_sesi'] @endphp
                @php $total_komisi_terapis = $total_komisi_terapis + $value['komisi_terapis'] @endphp
                @php $total = $total + $value['total'] @endphp
                <td class="text">{{ $loop->index + 1 }}</td>
                <td class="text">{{ $value['code'] }}</td>
                <td class="text">{{ $value['nama'] }}</td>
                <td class="text">{{ $value['nama_paket'] }}</td>
                <td class="text">{{ $value['sesi'] }}</td>
                <td class="text">{{ $value['qty_pdk'] }}</td>
                <td class="number">@convert($value['fee_sesi'])</td>
                <td class="number">@convert($value['komisi_terapis'])</td>
                <td class="number">@convert($value['total'])</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td style="background-color: unset;border:none" class="text" colspan="4"></td>
            <td class="text">@convert($total_sesi)</td>"4"></td>
            <td class="text">@convert($total_pdk)</td>
            <td class="number">@convert($total_fee_sesi)</td>
            <td class="number">@convert($total_komisi_terapis)</td>
            <td class="number">@convert($total)</td>
            @php $grand_qty_pdk = $grand_qty_pdk + $total_pdk @endphp
            @php $grand_total_sesi = $grand_total_sesi + $total_sesi @endphp
            @php $grand_total_fee_sesi = $grand_total_fee_sesi + $total_fee_sesi @endphp
            @php $grand_total_komisi_terapis = $grand_total_komisi_terapis + $total_komisi_terapis @endphp
            @php $grand_total = $grand_total + $total @endphp
        </tfoot>
    </table>
    <br>
    @endforeach

    <table class="customers">
        <tfoot>
            <tr>
                <td>Total Sesi:</td>
                <td class="text">{{ $grand_total_sesi }}</td>
            </tr>
            <tr>
                <td>Total Pdk:</td>
                <td class="text">{{ $grand_qty_pdk }} </td>
            </tr>
            <tr>
                <td>Total Fee Sesi:</td>
                <td class="number">@convert($grand_total_fee_sesi)</td>
            </tr>
            <tr>
                <td>Total Komisi Produk:</td>    
                <td class="number">@convert($grand_total_komisi_terapis)</td>
            </tr>
            <tr>
                <td>Grand Total:</td>   
                <td class="number">@convert($grand_total)</td>
            </tr>
        </tfoot>
    </table>

</body>
</html>