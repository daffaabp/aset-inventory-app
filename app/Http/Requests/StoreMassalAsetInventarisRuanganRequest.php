<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMassalAsetInventarisRuanganRequest extends FormRequest
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
            'tanggal_inventarisir' => 'nullable|date',
            'nama' => 'required|string',
            'tanggal_inventarisir' => 'nullable|date',
            'merk' => 'nullable|string',
            'volume' => 'nullable|string',
            'bahan' => 'nullable|string',
            'tahun' => 'required|numeric|digits:4',
            'harga' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'jumlah' => 'nullable|numeric|min:1',
        ];
    }
}