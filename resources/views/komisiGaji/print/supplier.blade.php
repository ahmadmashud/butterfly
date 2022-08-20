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
    <h1 style="text-align:center">Komisi Supplier</h1>
    <p style="text-align:center">{{HelperCustom::formatDate(@$tanggal_awal) }} s/d {{ HelperCustom::formatDate(@$tanggal_akhir) }}</p>
    <table id="customers">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Sesi</th>
                <th>Komisi Sesi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $value)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ HelperCustom::formatDate($value['tanggal']) }}</td>
                <td>{{ $value['nama'] }}</td>
                <td>{{ $value['sesi'] }}</td>
                <td class="number">@convert($value['total'])</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td style="background-color: unset;border:none" class="text" colspan="4"></td>
            <td class="number">@convert($total)</td>
        </tfoot>
    </table>
</body>

</html>