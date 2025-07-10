<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKelasRequest extends FormRequest
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
        return  [
            'guru_id' => 'required|not_in:Pilih Guru',
            'kelas' => 'required|not_in:Pilih Kelas--',
            'jurusan_id' => 'required|not_in:Pilih Jurusan--',
            'kategory' => 'required'
        ];
    }
    public function messages()
    {
        return  [
            'guru_id.not_in' => 'Guru harus Di isi',
            'kelas.not_in' => 'Kelas Harus Di isi',
            'jurusan_id.not_in' => 'Jurusan Harus di isi',
            'kategory.required' => 'Kategory Harus Di isi'
        ];
    }
}
