<?php

namespace App\Exports;

use App\Models\AsetGedung;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AsetGedungExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AsetGedung::with('statusAset')->get();
    }

    public function map($gedung): array
    {
        return [
            $gedung->id_aset_gedung,
            $gedung->statusAset->status_aset,
            $gedung->kode_aset,
            $gedung->nama,
            $gedung->tanggal_inventarisir,
            $gedung->kondisi,
            $gedung->bertingkat,
            $gedung->luas_lantai,
            $gedung->lokasi,
            $gedung->tahun_dok,
            $gedung->nomor_dok,
            $gedung->hak,
            $gedung->harga,
            $gedung->keterangan,
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
            'Kondisi',
            'Bertingkat',
            'Beton',
            'Luas Lantai',
            'Lokasi',
            'Tahun Dokumen',
            'Nomor Dokumen',
            'Luas',
            'Hak',
            'Harga',
            'Keterangan',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:P1')->applyFromArray([
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