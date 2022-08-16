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

class LaporanProductExport implements FromCollection, WithHeadings, WithColumnWidths, WithColumnFormatting, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $no = 0;
        return collect($this->data->map(function ($value) use (&$no) {
            $no++;
            $data = [
                'no' => $no,
                'trx_no' => $value->trx_no,
                'tanggal' => HelperCustom::formatDateTime($value->tanggal),
                'nama' => $value->nama,
                'price' =>  $value->harga,
                'qty' =>  $value->qty,
                'total' =>  $value->total,

            ];

            return $data;
        }));
    }

    public function headings(): array
    {
        return [
            [
                'No',
                'ID transaksi',
                'Tanggal',
                'Nama',
                'Harga',
                'Terjual',
                'Total'
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 15,
            'C' => 15,
            'D' => 18,
            'E' => 10,
            'F' => 15,
            'G' => 10,
            'H' => 10
        ];
    }

    public function columnFormats(): array
    {
        $number_format = "#,##0";
        return [
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
            'E' => $number_format,
            'G' => $number_format,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:H1')
                    ->getFont()
                    ->setBold(true);
            },
        ];
    }
}
