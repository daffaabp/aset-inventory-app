<?php

namespace App\Exports;

use App\Models\AsetInventarisRuangan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AsetInventarisExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AsetInventarisRuangan::with(['statusAset', 'ruangan'])->get();
    }

    private $rowCount = 0;

    public function map($inventaris): array
    {
        $this->rowCount++;

        return [
            $this->rowCount,
            $inventaris->statusAset->status_aset,
            $inventaris->ruangan->nama,
            $inventaris->kode_aset,
            $inventaris->nama,
            $inventaris->tanggal_inventarisir,
            $inventaris->merk,
            $inventaris->volume,
            $inventaris->bahan,
            $inventaris->tahun,
            $inventaris->harga,
            $inventaris->jumlah,
            $inventaris->keterangan,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Status Aset',
            'Nama Ruangan',
            'Kode Aset',
            'Nama Aset',
            'Tanggal Inventarisir',
            'Merk',
            'Volume',
            'Bahan',
            'Tahun',
            'Harga',
            'Jumlah',
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