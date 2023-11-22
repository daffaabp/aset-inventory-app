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
            'nama' => 'required',
            'tanggal_inventarisir' => 'nullable|date',
            'kondisi' => 'required',
            'bertingkat' => 'required',
            'beton' => 'required',
            'luas_lantai' => 'required',
            'lokasi' => 'required',
            'tahun_dok' => 'required',
            'nomor_dok' => 'required',
            'luas' => 'required',
            'hak' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
        ];
    }
}
