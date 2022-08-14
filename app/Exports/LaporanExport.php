<?php

namespace App\Exports;

use App\Helpers\HelperCustom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanExport implements FromCollection, WithHeadings, WithColumnWidths, WithColumnFormatting, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $laporanService;

    function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $no = 0;
        return collect($this->data->map(function ($value) use (&$no) {
            $no++;
            return [
                'no' => $no,
                'trx_no' => $value->trx_no,
                'tanggal' => HelperCustom::formatDateTime($value->tanggal_masuk),
                'loker_no' => $value->loker->no,
                'terapis' =>  $value->terapis->nama,
                'paket_nama' => $value->paket->nama,
                'harga_paket' => $value->amount_harga_paket,
                'jumlah_sesi' => $value->jumlah_sesi,
                'amount_total_diskon' => $value->amount_total_discount,
                'amount_harga_setelah_diskon' => $value->amount_harga_paket_setelah_diskon,
                'amount_harga_produk' => $value->amount_harga_produk,
                'amount_total_fnd' => $value->amount_total_fnd,
                'amount_total' => $value->amount_total,
                'amount_total_service_charge' => $value->amount_total_service_charge,
                'amount_grand_total' => $value->amount_grand_total,
                'amount_total_pajak' => $value->amount_total_pajak,
                'metode_pembayaran' => $value->payment != null ? config('constants.metode_pembayaran')[$value->payment->metode_pembayaran] : '-'
            ];
        }));
    }

    public function headings(): array
    {
        return [
            'No',
            'ID',
            'Tanggal',
            'Loker',
            'Terapis',
            'Paket',
            'Room',
            'Sesi',
            'Diskon',
            'Room Terdiskon',
            'Produk',
            'F&D',
            'Total',
            'Service Charge',
            'Grand Total',
            'Pajak',
            'Jenis Pembayaran'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A'=> 10,
            'B' => 15,
            'C' => 18,
            'D' => 10,
            'E' => 15,
            'F' => 10,
            'G' => 10,
            'H' => 10,
            'I' => 10,
            'J' => 15,
            'K' => 10,
            'L' => 10,
            'M' => 10,
            'N' => 13,
            'O' => 13,
            'P' => 10,
            'Q' => 13,
            'R' => 15,
        ];
    }

    public function columnFormats(): array
    {
        $number_format = "#,##0";
        return [
            'C' => NumberFormat::FORMAT_DATE_DATETIME,
            'G' => $number_format,
            'I' => $number_format,
            'J' => $number_format,
            'K' => $number_format,
            'L' => $number_format,
            'M' => $number_format,
            'N' => $number_format,
            'O' => $number_format,
            'P' => $number_format,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:Q1')
                    ->getFont()
                    ->setBold(true);
            },
        ];
    }
}
