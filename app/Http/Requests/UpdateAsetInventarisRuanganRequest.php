<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAsetInventarisRuanganRequest extends FormRequest
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
            // 'kode_aset' => 'required|unique:aset_inventaris_ruangan,kode_aset',
            'nama' => 'required',
            'tanggal_inventarisir' => 'nullable|date',
            'merk' => 'required',
            'volume' => 'required',
            'bahan' => 'required',
            'tahun' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required|integer',
        ];
    }
}
