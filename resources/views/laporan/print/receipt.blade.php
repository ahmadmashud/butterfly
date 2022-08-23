<!DOCTYPE html>
<html>

<head>
    <title>Butterfly Message</title>
</head>
<style>
    table {
        border-collapse: collapse;
        font-size: 12px;
        padding: 0;
        margin: 0;
    }

    /* And this to your table's `td` elements. */
    table td {
        padding: 0;
        margin: 0;
    }

    table tr th {
        padding: 0;
        margin: 0;
        text-align: left;
    }

    .title {
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
    <h1 style="text-align:center">Butterfly Message</h1>
    <hr width="100%" style="border-top: 3px line #bbb;" />
    <table style="width: 100%;">
        <tr class="title">
            <td> <label>Loker</label></td>
            <td>: </td>
            <td> {{ $data->loker->no }}</td>
        </tr>
        <tr class="title">
            <td> <label>Nama</label></td>
            <td>: </td>
            <td> {{ $data->nama_pelanggan }}</td>
        </tr>
        <tr class="title">
            <td> <label>Check In</label></td>
            <td>: </td>
            <td> {{ HelperCustom::formatDateTime($data->tanggal_masuk )}}</td>
        </tr>
        <tr class="title">
            <td> <label>Check Out</label></td>
            <td>: </td>
            <td> {{ HelperCustom::formatDateTime($data->tanggal_keluar) }}</td>
        </tr>
        <tr class="title">
            <td> <label>Therapist</label></td>
            <td>: </td>
            <td> {{ $data->terapis->nama }}</td>
        </tr>
    </table>
    <hr width="100%" style="border-top: 3px line #bbb;" />
    <table style="width: 100%;">
        <tr>
            <td colspan="4" class="title">
                SUITE
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <th colspan="2" style="text-align: left;">Room Name</th>
            <th>Session</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <td colspan="2">{{ $data->paket->nama }}</td>
            <td>{{ $data->jumlah_sesi }}</td>
            <td class="number">@convert($data->amount_harga_paket)</td>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td></td>

            <td class="number"><b>@convert( $data->jumlah_sesi*$data->amount_harga_paket )</b>

                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <!-- menu f*d -->

        @if($data->amount_total_fnd > 0)
        <tr>
            <td colspan="4" class="title">
                MENU CHARGE
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <th>Menu</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        @foreach($data->fnd as $key => $value)
        <tr>
            <td>{{ $value->foodDrink->nama }}</td>
            <td class="number">@convert( $value->price)</td>
            <td>{{ $value->qty }}</td>
            <td class="number">@convert( $value->total )</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="number"><b>@convert( $data->amount_total_fnd )</b>
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        @endif

        @if($data->amount_harga_produk > 0)
        <tr>
            <td colspan="4" class="title">
                AROMA THERAPY
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        @foreach($data->product_trx as $key => $value)
        <tr>
            <td>{{ $value->product->nama }}</td>
            <td class="number">@convert( $value->harga)</td>
            <td>{{ $value->qty }}</td>
            <td class="number">@convert( $value->total )</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="number"><b>@convert( $data->amount_harga_produk )</b>
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        @endif
        <tr>
            <td colspan="3"><b>Sub Total</b></td>
            <td class="number"><b>@convert( $data->amount_harga_produk + ($data->jumlah_sesi*$data->amount_harga_paket) + $data->amount_total_fnd)</b></td>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Room Disc</td>
            <td class="number">@convert( $data->amount_total_discount )</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Aroma Therapy</td>
            <td>0</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Member Disc</td>
            <td>0</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <td colspan="2">Service</td>
            <td class="number"><b>@convert( $data->amount_total_service_charge )</b></td>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <td colspan="3"><b>Grand Total</b></td>
            <td class="number"><b>@convert( $data->amount_grand_total )</b>

                <hr width="100%" style="border-top: 3px line #bbb;" />

                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <hr width="100%" style="border-top: 3px line #bbb;" />
            </td>
        </tr>

    </table>
</body>

</html>