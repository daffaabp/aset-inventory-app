<?php

namespace App\Imports;

use App\Imports\AsetInventarisImport;
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
        if (empty($row['kode_ruangan'])) {
            return null;
        }

        // Mapping ruangan
        $ruanganMapping = [
            'Paseban Bintang' => 'A',
            'Sekretariat' => 'B',
            'Graha Bina Satria' => 'C',
            'Pendopo Tunas Kencana' => 'D',
            'Komputer' => 'E',
            'Humas Studio' => 'F',
            'DKC' => 'G',
            'Dapur' => 'H',
            'Pusdiklat Kendalisada' => 'I',
            'Gudang Pusdiklatcab' => 'J',
            'Mushola' => 'K',
            'Perpustakaan' => 'L',
            'Koperasi - Kedai' => 'M',
            'Gudang Arsip' => 'N',
            'Kamar Penjaga Kwarcab' => 'O',
        ];
        $kodeRuangan = $ruanganMapping[$row['kode_ruangan']];

        // Jika kodeRuangan adalah 'DEFAULT', Anda bisa menangani kasus ini
        if ($kodeRuangan == 'DEFAULT') {
            // Lakukan penanganan sesuai dengan kebutuhan Anda, mungkin memberikan pesan kesalahan atau mengambil tindakan lain.
            // Contoh:
            return null;
        }

        // Ambil kode terakhir dari database
        $lastAset = AsetInventarisRuangan::where('kode_aset', 'like', '02.04.' . $kodeRuangan . '.%')
            ->orderBy('kode_aset', 'desc')
            ->first();

        // Jika ada kode terakhir, tambahkan satu untuk mendapatkan urutan berikutnya
        // Jika tidak, mulai dari 0001
        if ($lastAset) {
            $lastNumber = substr($lastAset->kode_aset, -4);
            $nextNumber = str_pad((int) $lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        // Gabungkan semua komponen untuk membuat kode aset yang baru
        $kodeInventaris = '02.04.' . $kodeRuangan . '.' . $nextNumber;

        $validator = Validator::make($row, $this->rules(), $this->customValidationMessages());

        if ($validator->fails()) {
            return null;
        }

        $this->rowCount++;

        // Mapping status aset
        $statusMapping = [
            'Tersedia' => 1,
            'Dipinjam' => 2,
            'Rusak' => 3,
        ];
        $statusId = $statusMapping[$row['id_status_aset']] ?? 0;

        $tanggalInventarisir = Carbon::createFromFormat('d/m/Y', $row['tanggal_inventarisir'])->format('Y-m-d');

        // Jika jumlah lebih dari 1, asumsikan ini akan dibuat secara massal
        if ($row['jumlah'] > 1) {
            $grupId = uniqid();

            $newAsets = [];

            for ($i = 0; $i < $row['jumlah']; $i++) {
                $formattedNumber = str_pad($nextNumber + $i, 4, '0', STR_PAD_LEFT);
                $newKodeAset = '02.04.' . $kodeRuangan . '.' . $formattedNumber;

                $newAsets[] = [
                    'id_status_aset' => $statusId,
                    'kode_aset' => $newKodeAset, // Kode aset tetap sama untuk setiap aset dalam grup
                    'kode_ruangan' => $kodeRuangan,
                    'grup_id' => $grupId,
                    'nama' => $row['nama'],
                    'tanggal_inventarisir' => $tanggalInventarisir,
                    'merk' => $row['merk'],
                    'volume' => $row['volume'],
                    'bahan' => $row['bahan'],
                    'tahun' => $row['tahun'],
                    'harga' => $row['harga'],
                    'jumlah' => 1, // Set jumlah ke 1 untuk setiap aset
                    'keterangan' => $row['keterangan'],
                ];
            }

            AsetInventarisRuangan::insert($newAsets);
        } else {

            // Jika jumlah 1, asumsikan ini adalah aset tunggal
            AsetInventarisRuangan::create([
                'id_status_aset' => $statusId,
                'kode_aset' => $kodeInventaris,
                'kode_ruangan' => $kodeRuangan,
                'nama' => $row['nama'],
                'tanggal_inventarisir' => $tanggalInventarisir,
                'merk' => $row['merk'],
                'volume' => $row['volume'],
                'bahan' => $row['bahan'],
                'tahun' => $row['tahun'],
                'harga' => $row['harga'],
                'jumlah' => 1,
                'keterangan' => $row['keterangan'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'id_status_aset' => 'required|in:Tersedia,Dipinjam,Rusak',
            'kode_ruangan' => 'required|in:Paseban Bintang,Sekretariat,Graha Bina Satria,Pendopo Tunas Kencana,Komputer,Humas Studio,DKC,Dapur,Pusdiklat Kendalisada,Gudang Pusdiklatcab,Mushola,Perpustakaan,Koperasi - Kedai,Gudang Arsip,Kamar Penjaga Kwarcab',

            'nama' => 'required|string|max:50',
            'tanggal_inventarisir' => 'required|date_format:d/m/Y',
            'merk' => 'nullable|string|max:255',
            'volume' => 'nullable|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'tahun' => 'required|numeric|digits:4',
            'jumlah' => 'nullable|numeric|min:1',
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

            'nama.required' => 'Nama Aset harus diisi',
            'nama.string' => 'Nama Aset harus bertipe string',
            'tanggal_inventarisir.required' => 'Tanggal Inventarisir wajib diisi',
            'tanggal_inventarisir.date_format' => 'Format tanggal Inventarisir harus berformat dd/mm/yyyy',
            'merk.nullable' => 'Merk tidak wajib diisi',
            'merk.string' => 'Merk wajib bertipe string',
            'volume.nullable' => 'Volume tidak wajib diisi',
            'volume.string' => 'Volume harus bertipe string',
            'bahan.nullable' => 'Bahan tidak wajib diisi',
            'bahan.string' => 'Bahan harus bertipe string',
            'tahun.required' => 'Tahun wajib diisi',
            'tahun.numeric' => 'Tahun harus bertipe numerik',
            'tahun.digits' => 'Tahun harus mempunyai minimal 4 digit angka',
            'jumlah.nullable' => 'Jumlah tidak wajib diisi',
            'jumlah.numeric' => 'Jumlah harus bertipe numerik',
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
