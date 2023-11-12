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
            // 'kode_aset' => 'required|unique:aset_kendaraan',
            'nama' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'cylinder' => 'required',
            'warna' => 'required',
            'no_rangka' => 'required',
            'no_mesin' => 'required',
            'thn_pembuatan' => 'required|date_format:Y',
            'thn_pembelian' => 'required|date_format:Y',
            'no_polisi' => 'required|unique:aset_kendaraan',
            'tgl_bpkb' => 'required|date',
            'no_bpkb' => 'required',
            'harga' => 'required',
            'keterangan' => 'nullable',
        ];
    }
}
