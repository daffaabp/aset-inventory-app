<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRuanganRequest extends FormRequest
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
            'nama' => 'required|string',
            'lokasi' => 'required|string',
        ];
    }

    public function messages()
    {
        return [

            'nama.required' => 'Nama Ruangan wajib diisi.',
            'nama.string' => 'Nama Ruangan harus berupa string.',
            'lokasi.required' => 'Lokasi Ruangan wajib diisi.',
            'lokasi.string' => 'Lokasi Ruangan harus berupa string.',
        ];
    }
}
