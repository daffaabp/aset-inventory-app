<?php

namespace App\Imports;

use App\Imports\AsetKendaraanImport;
use App\Models\AsetKendaraan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AsetKendaraanImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
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
        $tanggalBpkb = Carbon::createFromFormat('d/m/Y', $row['tgl_bpkb'])->format('Y-m-d');

        return new AsetKendaraan([
            'id_status_aset' => $statusId,
            'kode_aset' => $row['kode_aset'],
            'nama' => $row['nama'],
            'tanggal_inventarisir' => $tanggalInventarisir,
            'merk' => $row['merk'],
            'type' => $row['type'],
            'cylinder' => $row['cylinder'],
            'warna' => $row['warna'],
            'no_rangka' => $row['no_rangka'],
            'no_mesin' => $row['no_mesin'],
            'thn_pembuatan' => $row['thn_pembuatan'],
            'thn_pembelian' => $row['thn_pembelian'],
            'no_polisi' => $row['no_polisi'],
            'tgl_bpkb' => $tanggalBpkb,
            'no_bpkb' => $row['no_bpkb'],
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
                Rule::unique('aset_kendaraan', 'kode_aset'),
            ],
            'nama' => 'required|string|max:50',
            'tanggal_inventarisir' => 'required|date_format:d/m/Y',
            'merk' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'cylinder' => 'required|numeric',
            'warna' => 'required|string|max:255',
            'no_rangka' => 'required|string|max:255',
            'no_mesin' => 'required|string|max:255',
            'thn_pembuatan' => 'required|numeric',
            'thn_pembelian' => 'required|numeric',
            'no_polisi' => 'required|unique:aset_kendaraan|string|max:255',
            'tgl_bpkb' => 'nullable|date_format:d/m/Y',
            'no_bpkb' => 'nullable|string|max:255',
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
            'kode_aset.required' => 'Kode Aset harus diisi',
            'kode_aset.unique' => 'Kode Aset sudah ada di database',
            'kode_aset.string' => 'Kode Aset harus bertipe string',
            'nama.required' => 'Nama Aset harus diisi',
            'nama.string' => 'Nama Aset harus bertipe string',
            'tanggal_inventarisir.required' => 'Tanggal Inventarisir wajib diisi',
            'tanggal_inventarisir.date_format' => 'Format tanggal Inventarisir harus berformat dd/mm/yyyy',
            'merk.required' => 'Merk wajib diisi',
            'merk.string' => 'Merk wajib bertipe string',
            'type.required' => 'Type wajib diisi',
            'type.string' => 'Type harus bertipe string',
            'cylinder.required' => 'Cylinder wajib diisi',
            'cylinder.numeric' => 'Cylinder harus bertipe numerik',
            'warna.required' => 'Warna wajib diisi',
            'warna.string' => 'Warna harus bertipe string',
            'no_rangka.required' => 'Nomor Rangka wajib diisi',
            'no_rangka.string' => ' Nomor Rangka harus bertipe string',
            'no_mesin.required' => 'Nomor Mesin wajib diisi',
            'no_mesin.string' => 'Nomor Mesin harus bertipe string',
            'thn_pembuatan.required' => 'Tahun Pembuatan wajib diisi',
            'thn_pembuatan.numeric' => 'Tahun Pembuatan harus bertipe numerik',
            'thn_pembelian.required' => 'Tahun Pembelian wajib diisi',
            'thn_pembelian.numeric' => 'Tahun Pembelian harus bertipe numerik',
            'no_polisi.required' => 'Nomor Polisi wajib diisi',
            'no_polisi.string' => 'Nomor Polisi harus bertipe string',
            'no_polisi.unique' => 'Nomor Polisi sudah ada di database',
            'tgl_bpkb.nullable' => 'Tanggal BPKB tidak wajib diisi',
            'tgl_bpkb.date_format' => 'Tanggal BPKB harus berformat dd/mm/yyyy',
            'no_bpkb.nullable' => 'Nomor BPKB tidak wajib diisi',
            'no_bpkb.string' => 'Nomor BPKB harus bertipe string',
            'harga.required' => 'Harga wajib diisi, jika tidak ada isi dengan angka 0',
            'harga.numeric' => 'Harga harus bertipe numeric',
            'harga.min' => 'Harga tidak boleh negatif',
            'keterangan.required' => 'Keterangan wajib diisi',
            'keterangan.string' => 'Keterangan harus bertipe string',
        ];
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }
}
