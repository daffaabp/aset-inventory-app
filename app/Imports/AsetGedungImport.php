<?php

namespace App\Imports;

use App\Models\AsetGedung;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AsetGedungImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
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

        return new AsetGedung([
            'id_status_aset' => $statusId,
            'kode_aset' => $row['kode_aset'],
            'nama' => $row['nama'],
            'kode_aset' => $row['kode_aset'],
            'tanggal_inventarisir' => $tanggalInventarisir,
            'kondisi' => $row['kondisi'],
            'bertingkat' => $row['bertingkat'],
            'beton' => $row['beton'],
            'luas_lantai' => $row['luas_lantai'],
            'lokasi' => $row['lokasi'],
            'tahun_dok' => $row['tahun_dok'],
            'nomor_dok' => $row['nomor_dok'],
            'luas' => $row['luas'],
            'hak' => $row['hak'],
            'harga' => $row['harga'],
            'keterangan' => $row['keterangan'],
        ]);
    }

    public function rules(): array
    {
        return [
            'id_status_aset' => 'required|in:Tersedia,Dipinjam,Rusak',
            'kode_aset' => [
                'required',
                'string',
                'max:255',
                Rule::unique('aset_gedung', 'kode_aset'),
            ],
            'nama' => 'required|string|max:50',
            'tanggal_inventarisir' => 'required|date_format:d/m/Y',
            'kondisi' => 'required|string|max:255',
            'bertingkat' => 'required|string|max:255',
            'beton' => 'required|string|max:255',
            'luas_lantai' => 'required|numeric|min:0',
            'lokasi' => 'required|string|max:255',
            'tahun_dok' => 'required|numeric|min:0|digits:4',
            'luas' => 'required|numeric|min:0',
            'hak' => 'required|string|max:255',
            'harga' => [
                'required',
                'numeric',
                'min:0',
            ],
            'keterangan' => 'required|string|max:255',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'id_status_aset.required' => 'Status Aset harus diisi dan bernilai Tersedia, Dipinjam, atau Rusak.',
            'kode_aset.required' => 'Kode Aset harus diisi.',
            'kode_aset.unique' => 'Kode Aset sudah ada di database.',
            'nama.required' => 'Nama Aset harus diisi',
            'nama.string' => 'Nama Aset harus bertipe string',
            'tanggal_inventarisir.required' => 'Tanggal Inventarisir wajib diisi',
            'tanggal_inventarisir.date_format' => 'Format tanggal Inventarisir harus dd/mm/yyyy',
            'kondisi.required' => 'Kondisi wajib diisi',
            'kondisi.string' => 'Kondisi wajib bertipe string',
            'bertingkat.required' => 'Bertingkat wajib diisi',
            'bertingkat.string' => 'Bertingkat harus bertipe string',
            'beton.required' => 'Beton wajib diisi',
            'beton.string' => 'Beton harus bertipe string',
            'luas_lantai.required' => 'Luas Lantai wajib diisi',
            'luas_lantai.numeric' => 'Luas Lantai harus bertipe numerik',
            'lokasi.required' => 'Lokasi wajib diisi',
            'lokasi.string' => 'Lokasi harus bertipe string',
            'tahun_dok.required' => 'Tahun Dokumen wajib diisi',
            'tahun_dok.numeric' => 'Tahun Dokumen harus bertipe numerik',
            'tahun_dok.digits' => 'Tahun Dokumen minimal berisi 4 digits',
            'luas.required' => 'Luas wajib diisi',
            'luas.numeric' => 'Luas harus bertipe numerik',
            'hak.required' => 'Hak wajib diisi',
            'hak.string' => 'Hak harus bertipe string',
            'harga.required' => 'Harga wajib diisi',
            'harga.string' => 'Harga harus bertipe string',
            'keterangan.required' => 'Keterangan wajib diisi',
            'keterangan.string' => 'Keterangan harus bertipe string',
        ];
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }
}
