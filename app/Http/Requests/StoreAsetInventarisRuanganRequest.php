<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsetInventarisRuanganRequest extends FormRequest
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
            'id_status_aset' => 'required|exists:status_aset,id_status_aset',
            'kode_ruangan' => 'required|exists:ruangan,kode_ruangan',

            'grup_id' => 'nullable|unique:aset_inventaris_ruangan,grup_id',
            'nama' => 'required|string|max:255',
            'tanggal_inventarisir' => 'required|date',
            'merk' => 'nullable|string|max:255',
            'volume' => 'nullable|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'tahun' => 'required|numeric|digits:4|min:0',
            'harga' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'nullable|numeric|min:1',
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
            'kode_ruangan.required' => 'Kode Ruangan wajib diisi',

            'nama.required' => 'Nama Aset harus diisi',
            'nama.string' => 'Nama Aset harus bertipe string',
            'tanggal_inventarisir.required' => 'Tanggal Inventarisir wajib diisi',
            'tanggal_inventarisir.date' => 'Tanggal Inventarisir harus bertipe tanggal',
            'merk.nullable' => 'Merk tidak wajib diisi',
            'merk.string' => 'Merk harus bertiipe string',
            'volume.nullable' => 'Volume tidak wajib diisi',
            'volume.string' => 'Volume harus bertipe string',
            'bahan.nullable' => 'Bahan tidak wajib diisi',
            'bahan.string' => 'Bahan harus bertipe string',
            'tahun.required' => 'Tahun wajib diisi',
            'tahun.numeric' => 'Tahun harus bertipe numerik',
            'tahun.digits' => 'Tahun minimal harus 4 digit',
            'tahun.min' => 'Tahun tidak boleh angka negatif',
            'harga.required' => 'Harga wajib diisi, jika tidak ada masukkan angka 0',
            'harga.numeric' => 'Harga harus bertipe numerik',
            'harga.min' => 'Harga tidak boleh negatif, minimal 0',
            'keterangan.required' => 'Keterangan wajib diisi, jika kosong maka tuliskan (-)',
            'keterangan.string' => 'Keterangan harus bertipe string',
            'jumlah.nullable' => 'Jumlah tidak wajib diisi',
            'jumlah.numeric' => 'Jumlah harus bertipe numerik',
            'jumlah.min' => 'Jumlah minimal harus berisi angka 1',
        ];
    }
}
