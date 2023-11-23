<?php

namespace App\Exports;

use App\Models\AsetTanah;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AsetTanahExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;

    public function collection()
    {
        return AsetTanah::with('statusAset')->get();
    }

    public function map($tanah): array
    {
        return [
            $tanah->id_aset_tanah,
            $tanah->statusAset->status_aset,
            $tanah->kode_aset,
            $tanah->nama,
            $tanah->tanggal_inventarisir,
            $tanah->luas,
            $tanah->letak_tanah,
            $tanah->hak,
            $tanah->tanggal_sertifikat,
            $tanah->no_sertifikat,
            $tanah->penggunaan,
            $tanah->harga,
            $tanah->keterangan,
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
            'Luas',
            'Letak Tanah',
            'Hak',
            'Tanggal Sertifikat',
            'No. Sertifikat',
            'Penggunaan',
            'Harga',
            'Keterangan',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:M1')->applyFromArray([
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
