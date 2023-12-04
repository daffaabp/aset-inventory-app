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
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AsetTanahExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;

    public function collection()
    {
        return AsetTanah::with('statusAset')->get();
    }

    private $rowCount = 0;

    public function map($tanah): array
    {
        $this->rowCount++;

        return [
            $this->rowCount,
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
            $tanah->harga === 0 ? '0' : $tanah->harga,
            $tanah->keterangan,
        ];
    }

    public function headings(): array
    {
        $richText = new RichText();
        $richText->createText('Luas (m');

        $superscript = $richText->createTextRun('2');
        $superscript->getFont()->setSuperscript(true);

        $richText->createText(')');

        return [
            'No',
            'Status Aset',
            'Kode Aset',
            'Nama Aset',
            'Tanggal Inventarisir',
            $richText,
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

                // Set border untuk seluruh data
                $event->sheet->getStyle('A1:M' . $event->sheet->getHighestRow())
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // Set auto size untuk semua kolom
                foreach (range('A', 'M') as $column) {
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },

        ];
    }

}
