<?php

namespace App\Imports;

use App\Models\AsetTanah;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AsetTanahImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
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
        // Validasi jika 'kode_aset' kosong
        if (empty($row['kode_aset'])) {
            return null; // Abaikan baris ini jika 'kode_aset' kosong
        }

        // Validasi data sebelum membuat model
        $validator = Validator::make($row, $this->rules(), $this->customValidationMessages());

        if ($validator->fails()) {
            // Handle kesalahan validasi di sini, contohnya bisa di-log atau diambil ke dalam session.
            return null;
        }

        // Increment jumlah baris setiap kali model berhasil dibuat
        $this->rowCount++;

        // Konversi status ke nilai angka
        $status = $row['id_status_aset'];
        // switch ($status) {
        //     case 'Tersedia':
        //         $statusId = 1;
        //         break;
        //     case 'Dipinjam':
        //         $statusId = 2;
        //         break;
        //     case 'Rusak':
        //         $statusId = 3;
        //         break;
        //     default:
        //         $statusId = 0; // Atau sesuaikan dengan default yang dibutuhkan
        // }

        //akan lebih baik menggunakan if else

        if($status == 'Tersedia'){
            $statusId = 1;
        }elseif($status == 'Dipinjam'){
            $statusId = 2;
        }elseif($status == 'Rusak'){
            $statusId = 3;
        }else{
            return false;
        }

        //lakukan query untuk mengecek data di asset tanah




        $tanggalInventarisir = Carbon::createFromFormat('d/m/Y', $row['tanggal_inventarisir'])->format('Y-m-d');
        $tanggalSertifikat = Carbon::createFromFormat('d/m/Y', $row['tanggal_sertifikat'])->format('Y-m-d');

        return new AsetTanah([
            'id_status_aset' => $statusId,
            'kode_aset' => $row['kode_aset'],
            'nama' => $row['nama'],
            'tanggal_inventarisir' => $tanggalInventarisir,
            'luas' => $row['luas'],
            'letak_tanah' => $row['letak_tanah'],
            'hak' => $row['hak'],
            'tanggal_sertifikat' => $tanggalSertifikat,
            'no_sertifikat' => $row['no_sertifikat'],
            'penggunaan' => $row['penggunaan'],
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
                Rule::unique('aset_tanah', 'kode_aset'),
            ],
            'nama' => 'required|string|max:50',
            'tanggal_inventarisir' => 'required|date_format:d/m/Y',
            'luas' => 'required|numeric|min:0',
            'letak_tanah' => 'required|string|max:255',
            'hak' => 'required|string|max:255',
            'tanggal_sertifikat' => 'required|date_format:d/m/Y',
            'no_sertifikat' => 'nullable|string|max:255',
            'penggunaan' => 'required|string|max:255',
            'harga' => [
                'required',
                'numeric',
                'min:0',
            ],
            'keterangan' => 'nullable|string|max:255',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'id_status_aset.required' => 'Status Aset harus diisi dan bernilai Tersedia, Dipinjam, atau Rusak.',
            'kode_aset.required' => 'Kode Aset harus diisi.',
            'kode_aset.unique' => 'Kode Aset sudah ada di database.',
            'nama.required' => 'Nama Aset harus diisi',
            'tanggal_inventarisir.required' => 'Tanggal Inventarisir wajib diisi',
            'tanggal_inventarisir.date_format' => 'Format tanggal Inventarisir harus dd/mm/yyyy',
            'luas.required' => 'Luas wajib diisi',
            'luas.numeric' => 'Luas harus bertipe numerik',
            'letak_tanah.required' => 'Letak tanah wajib diisi',
            'hak.required' => 'Hak tanah wajib diisi',
            'tanggal_sertifikat.required' => 'Tanggal sertifikat wajib diisi',
            'tanggal_sertifikat.date_format' => 'Format tanggal sertifikat harus dd/mm/yyyy',
            'no_sertifikat.nullable' => 'No sertifikat tidak wajib diisi',
            'penggunaan.required' => 'Penggunaan wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'harga.numeric' => 'Harga harus bertipe numeric',
            'harga.min' => 'Harga tidak boleh negatif',
            'keterangan.string' => 'Keterangan harus bertipe string',
        ];
    }

    // Metode untuk mendapatkan jumlah baris yang berhasil diimpor
    public function getRowCount()
    {
        return $this->rowCount;
    }
}