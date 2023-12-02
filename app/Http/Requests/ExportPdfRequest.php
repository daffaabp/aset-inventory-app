<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportPdfRequest extends FormRequest
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
            'opsi' => 'required|in:Semua Data,Data Tahun Ini,Berdasarkan Ruang,Berdasarkan Tahun Perolehan',
            'ruangan_id' => 'required_if:opsi,Berdasarkan Ruang|exists:ruangan,kode_ruangan',
            'tahun_perolehan' => 'nullable|numeric|digits:4',
            'tahun_perolehan2' => 'nullable|numeric|digits:4',
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
            'tahun_perolehan.numeric' => 'Tahun Perolehan harus bertipe numerik',
            'tahun_perolehan.digits' => 'Tahun Perolehan harus angka 4 digit',
            'tahun_perolehan2.numeric' => 'Tahun Perolehan harus bertipe numerik',
            'tahun_perolehan2.digits' => 'Tahun Perolehan harus angka 4 digit',
        ];
    }

    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return response()->json(['message' => $errors], 422);
        }

        parent::response($errors);
    }
}
