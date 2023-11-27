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

            'nama' => 'required',
            'tanggal_inventarisir' => 'nullable|date',
            'merk' => 'required|string',
            'type' => 'required|string',
            'cylinder' => 'required|numeric',
            'warna' => 'required|string',
            'no_rangka' => 'required|string',
            'no_mesin' => 'required|string',
            'thn_pembuatan' => 'required|numeric|digits:4',
            'thn_pembelian' => 'required|numeric|digits:4',
            'no_polisi' => 'required|unique:aset_kendaraan|string',
            'tgl_bpkb' => 'nullable|date',
            'no_bpkb' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
        ];
    }
}
