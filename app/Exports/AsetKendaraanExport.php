<?php

namespace App\Exports;

use App\Models\AsetKendaraan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AsetKendaraanExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AsetKendaraan::with('statusAset')->get();
    }

    private $rowCount = 0;

    public function map($kendaraan): array
    {
        $this->rowCount++;

        return [
            $this->rowCount,
            $kendaraan->statusAset->status_aset,
            $kendaraan->kode_aset,
            $kendaraan->nama,
            $kendaraan->tanggal_inventarisir,
            $kendaraan->merk,
            $kendaraan->type,
            $kendaraan->cylinder,
            $kendaraan->warna,
            $kendaraan->no_rangka,
            $kendaraan->no_mesin,
            $kendaraan->thn_pembuatan,
            $kendaraan->thn_pembelian,
            $kendaraan->no_polisi,
            $kendaraan->tgl_bpkb,
            $kendaraan->no_bpkb,
            $kendaraan->harga,
            $kendaraan->keterangan,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Status Aset',
            'Kode Aset',
            'Nama Aset',
            'Tanggal Inventarisir',
            'Merk',
            'Type',
            'Cylinder',
            'Warna',
            'No. Rangka',
            'No. Mesin',
            'Thn Pembuatan',
            'Thn Pembelian',
            'No. Polisi',
            'Tgl. BPKB',
            'No. BPKB',
            'Harga',
            'Keterangan',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:R1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFFF00',
                        ],
                    ],
                ]);
            },
        ];
    }
}
