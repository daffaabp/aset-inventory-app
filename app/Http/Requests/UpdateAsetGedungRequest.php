<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAsetGedungRequest extends FormRequest
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
            'id_aset_gedung' => 'required',
            'id_status_aset' => 'required',
            // 'kode_aset' => 'required|unique:aset_gedung,kode_aset',
            'nama' => 'required',
            'tanggal_inventarisir' => 'nullable|date',
            'kondisi' => 'required',
            'bertingkat' => 'required',
            'beton' => 'required',
            'luas_lantai' => 'required',
            'lokasi' => 'required',
            'tahun_dok' => 'required|digits:4',
            'nomor_dok' => 'required|string',
            'luas' => 'required',
            'hak' => 'required',
            'harga' => [
                'required',
                'integer',
                'min:0',
            ],
            'keterangan' => 'required',
        ];
    }
}
