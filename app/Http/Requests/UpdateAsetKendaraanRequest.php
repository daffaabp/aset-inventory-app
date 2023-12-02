<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAsetKendaraanRequest extends FormRequest
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

            'nama' => 'required|string',
            'tanggal_inventarisir' => 'nullable|date',
            'merk' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'cylinder' => 'required|numeric|min:0',
            'warna' => 'required|string|max:255',
            'no_rangka' => 'required|string|max:255',
            'no_mesin' => 'required|string|max:255',
            'thn_pembuatan' => 'required|numeric|digits:4|min:0',
            'thn_pembelian' => 'required|numeric|digits:4|min:0',

            'tgl_bpkb' => 'nullable|date',
            'no_bpkb' => 'nullable|string|max:255',
            'harga' => [
                'required',
                'numeric',
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

            'nama.required' => 'Nama Aset harus diisi',
            'nama.string' => 'Nama Aset harus bertipe string',
            'tanggal_inventarisir.required' => 'Tanggal Inventarisir wajib diisi',
            'tanggal_inventarisir.date' => 'Tanggal Inventarisir harus bertipe tanggal',
            'merk.required' => 'Merk wajib diisi',
            'merk.string' => 'Merk harus bertiipe string',
            'type.required' => 'Type wajib diisi',
            'type.string' => 'Type harus bertipe string',
            'cylinder.required' => 'Cylinder wajib diisi, jika tidak ada masukkan angka 0',
            'cylinder.numeric' => 'Cylinder harus bertipe numerik',
            'cylinder.min' => 'Cylinder tidak boleh negatif, minimal 0',
            'warna.required' => 'Warna wajib diisi',
            'warna.string' => 'Warna harus bertipe string',
            'no_rangka.required' => 'Nomor Rangka wajib diisi',
            'no_rangka.string' => 'Nomor Rangka harus bertipe string',
            'no_mesin.required' => 'Nomor Mesin wajib diisi',
            'no_mesin.string' => 'Nomor Mesin harus bertipe string',
            'thn_pembuatan.required' => 'Tahun Pembuatan wajib diisi',
            'thn_pembuatan.numeric' => 'Tahun Pembuatan harus bertipe numerik',
            'thn_pembuatan.digits' => 'Tahun Pembuatan minimal harus 4 digit',
            'thn_pembuatan.min' => 'Tahun Pembuatan tidak boleh angka negatif',
            'thn_pembelian.required' => 'Tahun Pembelian wajib diisi',
            'thn_pembelian.numeric' => 'Tahun Pembelian harus bertipe numerik',
            'thn_pembelian.digits' => 'Tahun Pembelian minimal harus 4 digit',
            'thn_pembelian.min' => 'Tahun Pembelian tidak boleh angka negatif',

            'tgl_bpkb.nullable' => 'Tanggal BPKB tidak wajib diisi',
            'tgl_bpkb.date' => 'Tanggal BPKB harus bertipe tanggal',
            'no_bpkb.nullable' => 'Nomor BPKB tidak wajib diisi',
            'no_bpkb.string' => 'Nomor BPKB harus bertipe string',
            'harga.required' => 'Harga wajib diisi, jika tidak ada masukkan angka 0',
            'harga.numeric' => 'Harga harus bertipe numerik',
            'harga.min' => 'Harga tidak boleh negatif, minimal 0',
            'keterangan.required' => 'Keterangan wajib diisi, jika kosong maka tuliskan (-)',
            'keterangan.string' => 'Keterangan harus bertipe string',
        ];
    }
}
