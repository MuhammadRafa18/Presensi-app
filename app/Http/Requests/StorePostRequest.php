<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'nisn' => 'required|min:4',
            'nama' => 'required|min:4',
            'gender' => 'required|not_in:Pilih Gender--',
            'kelas_id' => 'required|not_in:Pilih kelas anda--'
        ];
    }
    public function messages(): array
    {
        return [
            'nisn.required' => ':attribute Tidak boleh kosong',
            'nama.required' => ':attribute Tidak boleh kosong',
            'gender.not_in' => 'Wajib mengisi gender',
            'kelas_id.not_in' => 'Wajib mengisi kelas'
        ];
    }
    public function attributes(): array
    {
        return [
            'nisn' => 'Nisn',
            'nama' => 'Nama'
        ];
    }
}
