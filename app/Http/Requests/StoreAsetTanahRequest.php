<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsetTanahRequest extends FormRequest
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
            'kode_aset' => 'required|unique:aset_tanah,kode_aset',
            'nama' => 'required|string',
            'tanggal_inventarisir' => 'nullable|date',
            'luas' => 'required|numeric|min:0',
            'letak_tanah' => 'required|string|max:255',
            'hak' => 'required|string|max:255',
            'tanggal_sertifikat' => 'required',
            'no_sertifikat' => 'nullable|string|max:255',
            'penggunaan' => 'required|string|max:255',
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
            'nama.string' => 'Nama Aset harus bertipe string',
            'tanggal_inventarisir.required' => 'Tanggal Inventarisir wajib diisi',
            'luas.required' => 'Luas wajib diisi',
            'luas.numeric' => 'Luas harus bertipe numerik',
            'luas.min' => 'Luas tidak boleh bernilai negatif',
            'letak_tanah.required' => 'Letak tanah wajib diisi',
            'hak.required' => 'Hak tanah wajib diisi',
            'tanggal_sertifikat.required' => 'Tanggal sertifikat wajib diisi',
            'no_sertifikat.nullable' => 'No sertifikat tidak wajib diisi',
            'penggunaan.required' => 'Penggunaan wajib diisi',
            'harga.required' => 'Harga wajib diisi, jika tidak ada masukkan angka 0',
            'harga.numeric' => 'Harga harus bertipe numerik',
            'harga.min' => 'Harga tidak boleh negatif, minimal 0',
            'keterangan.required' => 'Keterangan wajib diisi, jika kosong maka tuliskan (-)',
            'keterangan.string' => 'Keterangan harus bertipe string',
        ];
    }

}
