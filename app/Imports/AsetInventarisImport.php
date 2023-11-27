<?php

namespace App\Imports;

use App\Models\AsetInventarisRuangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AsetInventarisImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    private $rowCount = 0;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (empty($row['kode_aset'])) {
            return null;
        }

        $validator = Validator::make($row, $this->rules(), $this->customValidationMessages());

        if ($validator->fails()) {
            return null;
        }

        $this->rowCount++;

        $status = $row['id_status_aset'];
        switch ($status) {
            case 'Tersedia':
                $statusId = 1;
                break;
            case 'Dipinjam':
                $statusId = 2;
                break;
            case 'Rusak':
                $statusId = 3;
                break;
            default:
                $statusId = 0;
        }

        $tanggalInventarisir = Carbon::createFromFormat('d/m/Y', $row['tanggal_inventarisir'])->format('Y-m-d');

        return new AsetInventarisRuangan([

        ]);
    }
}
