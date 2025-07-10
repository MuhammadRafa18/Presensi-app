<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenUpdateRequest extends FormRequest
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
            'siswa_id' => 'required|not_in:Nama',
            'kelas_id' => 'required',
            'waktu' => 'required',
            'status' => 'required|not_in:Status',
            'deskripsi' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'siswa_id.not_in' => 'Wajib Mengisi Nama',
            'kelas_id.required' => ' Kelas Tidak boleh kosong',
            'waktu.required' => 'Wajib mengisi Tanggal',
            'status.not_in' => 'Wajib mengisi Status',
            'deskripsi.required' => 'Wajib mengisi Keterangan'
        ];
    }
}
