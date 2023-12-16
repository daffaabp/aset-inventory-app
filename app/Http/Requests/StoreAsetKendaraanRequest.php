<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsetKendaraanRequest extends FormRequest
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
            'cylinder' => 'required|numeric',
            'warna' => 'required|string|max:255',
            'no_rangka' => 'required|unique:aset_kendaraan|string|max:255',
            'no_mesin' => 'required|unique:aset_kendaraan|string|max:255',
            'thn_pembelian' => 'required|numeric|gte:thn_pembuatan',
            'no_polisi' => 'required|unique:aset_kendaraan|string|max:255',
            'tgl_bpkb' => 'nullable|date_format:d/m/Y',
            'no_bpkb' => 'nullable|unique:aset_kendaraan|string|max:255',
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
            'cylinder.required' => 'Cylinder wajib diisi',
            'cylinder.numeric' => 'Cylinder harus bertipe numerik',
            'warna.required' => 'Warna wajib diisi',
            'warna.string' => 'Warna harus bertipe string',
            'no_rangka.required' => 'Nomor Rangka wajib diisi',
            'no_rangka.unique' => 'Nomor Rangka sudah ada di database (wajib unik)',
            'no_rangka.string' => ' Nomor Rangka harus bertipe string',
            'no_mesin.required' => 'Nomor Mesin wajib diisi',
            'no_mesin.unique' => 'Nomor Mesin sudah ada di database (wajib unik)',
            'no_mesin.string' => 'Nomor Mesin harus bertipe string',
            'thn_pembuatan.required' => 'Tahun Pembuatan wajib diisi',
            'thn_pembuatan.numeric' => 'Tahun Pembuatan harus bertipe numerik',
            'thn_pembelian.required' => 'Tahun Pembelian wajib diisi',
            'thn_pembelian.numeric' => 'Tahun Pembelian harus bertipe numerik',
            'thn_pembelian.gte' => 'Tahun pembelian harus kurang dari atau sama dengan tahun pembuatan.',
            'no_polisi.required' => 'Nomor Polisi wajib diisi',
            'no_polisi.string' => 'Nomor Polisi harus bertipe string',
            'no_polisi.unique' => 'Nomor Polisi sudah ada di database (wajib unik)',
            'tgl_bpkb.nullable' => 'Tanggal BPKB tidak wajib diisi',
            'tgl_bpkb.date_format' => 'Tanggal BPKB harus berformat dd/mm/yyyy',
            'no_bpkb.nullable' => 'Nomor BPKB tidak wajib diisi',
            'no_bpkb.unique' => 'Nomor BPKB sudah ada di database (wajib unik)',
            'no_bpkb.string' => 'Nomor BPKB harus bertipe string',
            'harga.required' => 'Harga wajib diisi, jika tidak ada isi dengan angka 0',
            'harga.numeric' => 'Harga harus bertipe numeric',
            'harga.min' => 'Harga tidak boleh negatif',
            'keterangan.required' => 'Keterangan wajib diisi',
            'keterangan.string' => 'Keterangan harus bertipe string',
        ];
    }
}