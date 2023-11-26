<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsetGedungImportRequest extends FormRequest
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
            'file' => 'required|mimes:xlsx|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'File harus diunggah.',
            'file.mimes' => 'File harus berformat xlsx (Excel).',
            'file.max' => 'File tidak boleh lebih dari 2 Mb.',
        ];
    }
}
