<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'mapel_id' => 'required|not_in:Mata Pelajaran',
            'waktu' => 'required',
            'status.*' => 'not_in:Status',
            'deskripsi.*' => 'required',

        ];
    }
    public function messages(): array
    {
        return [
            'mapel_id.not_in' => ' Wajib Mengisi Mata Pelajaran',
            'waktu.required' => 'Wajib mengisi Tanggal',
            'status.*.not_in' => 'Wajib mengisi Status',
            'deskripsi.*.required' => 'Wajib mengisi Keterangan',
        ];
    }
}
