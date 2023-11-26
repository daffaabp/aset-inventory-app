<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAsetTanahRequest extends FormRequest
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
            'id_aset_tanah' => 'required',
            'id_status_aset' => 'required',
            // 'kode_aset' => 'required|unique:aset_tanah',
            'nama' => 'required',
            'tanggal_inventarisir' => 'nullable|date',
            'luas' => 'required',
            'letak_tanah' => 'required',
            'hak' => 'required',
            'tanggal_sertifikat' => 'required',
            'no_sertifikat' => 'required',
            'penggunaan' => 'required',
            'harga' => [
                'required',
                'integer',
                'min:1',
            ],
            'keterangan' => 'required',
        ];
    }
}
