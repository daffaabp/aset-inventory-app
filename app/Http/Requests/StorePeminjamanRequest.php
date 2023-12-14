<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeminjamanRequest extends FormRequest
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
            'kegunaan' => 'required|string|max:255',
            'tgl_rencana_pinjam' => 'required|date|after_or_equal:today',
            'tgl_rencana_kembali' => 'required|date|after:tgl_rencana_pinjam',
        ];
    }

    public function messages(): array
    {
        return [
            'tgl_rencana_pinjam.required' => 'Tanggal rencana pinjam harus diisi.',
            'tgl_rencana_pinjam.date' => 'Tanggal rencana pinjam harus berupa format tanggal yang valid.',
            'tgl_rencana_pinjam.after_or_equal' => 'Tanggal rencana pinjam harus setidaknya hari ini atau setelahnya.',

            'tgl_rencana_kembali.required' => 'Tanggal rencana kembali harus diisi.',
            'tgl_rencana_kembali.date' => 'Tanggal rencana kembali harus berupa format tanggal yang valid.',
            'tgl_rencana_kembali.after' => 'Tanggal rencana kembali harus setelah tanggal rencana pinjam.',
        ];
    }
}
