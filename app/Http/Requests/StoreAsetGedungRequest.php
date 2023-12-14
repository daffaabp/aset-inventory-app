<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsetGedungRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_status_aset' => 'required',
            'kode_aset' => 'required|unique:aset_gedung,kode_aset',
            'nama' => 'required|string',
            'tanggal_inventarisir' => 'nullable|date',
            'kondisi' => 'required|string|max:255',
            'bertingkat' => 'required|string|max:255',
            'beton' => 'required|string|max:255',
            'luas_lantai' => 'nullable|numeric|min:0',
            'lokasi' => 'required|string|max:255',
            'tahun_dok' => 'required|numeric|digits:4',
            'nomor_dok' => 'required|string',
            'luas' => 'nullable|numeric|min:0',
            'hak' => 'required|string|max:255',
            'harga' => [
                'required',
                'integer',
                'min:0',
            ],
            'keterangan' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id_status_aset.required' => 'Status Aset wajib diisi',
            'kode_aset.required' => 'Kode Aset harus diisi.',
            'kode_aset.unique' => 'Kode Aset sudah ada di database.',
            'nama.required' => 'Nama Aset harus diisi',
            'tanggal_inventarisir.required' => 'Tanggal Inventarisir wajib diisi',
            'kondisi.required' => 'Kondisi Aset harus diisi',
            'kondisi.string' => 'Kondisi Aset harus bertipe string',
            'bertingkat.required' => 'Bertingkat harus diisi',
            'bertingkat.string' => 'Bertingkat harus bertipe string',
            'beton.required' => 'Beton harus diisi',
            'beton.string' => 'Beton harus bertipe string',
            'luas_lantai.nullable' => 'Luas lantai tidak wajib diisi',
            'luas_lantai.numeric' => 'Luas lantai harus bertipe numerik',
            'luas_lantai.min' => 'Luas lantai tidak boleh bernilai negatif',
            'lokasi.required' => 'Lokasi wajib diisi',
            'lokasi.string' => 'Lokasi harus bertipe string',
            'tahun_dok.required' => 'Tahun Dokumen wajib diisi',
            'tahun_dok.numeric' => 'Tahun Dokumen harus bertipe numerik',
            'tahun_dok.digits' => 'Tahun Dokumen harus minimal 4 digit',
            'nomor_dok.required' => 'Nomor dokumen wajib diisi',
            'nomor_dok.string' => 'Nomor dokumen harus bertipe string',
            'luas.nullable' => 'Luas tidak wajib diisi',
            'luas.numeric' => 'Luas harus bertipe numerik',
            'luas.min' => 'Luas tidak boleh bernilai negatif',
            'hak.required' => 'Hak wajib diisi',
            'hak.string' => 'Hak harus bertipe string',
            'harga.required' => 'Harga wajib diisi, jika tidak ada masukkan angka 0',
            'harga.numeric' => 'Harga harus bertipe numerik',
            'harga.min' => 'Harga tidak boleh bernilai negatif',
            'keterangan.required' => 'Keterangan wajib diisi, jika kosong maka tuliskan (-)',
            'keterangan.string' => 'Keterangan harus bertipe string',
        ];
    }
}