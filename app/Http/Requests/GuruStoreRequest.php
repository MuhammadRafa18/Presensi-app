<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuruStoreRequest extends FormRequest
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
            'nama' => 'required|min:4',
            'gender' => 'required|not_in:Pilih Gender--',
            'kode_mapel' => 'required',
            'mapel_id' => 'required|not_in:Pilih Mata Pelajaran--'
        ];
    }
    public function messages()
    {
        return [
            'nama.required' => ':attribute Tidak Boleh Kosong',
            'gender.not_in' => 'Wajib Mengisi Gender ',
            'kode_mapel.required' => 'Wajib mengisi Kode Guru',
            'mapel_id.not_in' => 'Wajib Mengisi Mata Pelajaran'
        ];
    }
    public function attributes()
    {
        return [
            'nama' => 'Nama'
        ];
    }
}
