<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportPdfAsetGedungRequest extends FormRequest
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
            'tahun_dok' => 'nullable|numeric|digits:4',
            'tahun_dok2' => 'nullable|numeric|digits:4',
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
            'tahun_dok.nullable' => 'Tahun Dokumen tidak wajib diisi',
            'tahun_dok.numeric' => 'Tahun Dokumen harus bertipe numerik',
            'tahun_dok.digits' => 'Tahun Dokumen harus angka 4 digit',
            'tahun_dok2.nullable' => 'Tahun Dokumen tidak wajib diisi',
            'tahun_dok2.numeric' => 'Tahun Dokumen harus bertipe numerik',
            'tahun_dok2.digits' => 'Tahun Dokumen harus angka 4 digit',
        ];
    }
}