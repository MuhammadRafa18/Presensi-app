<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest as RequestsStorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use Dotenv\Util\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request\StorePostRequest;
use App\Models\Jurusan;

class SiswaController extends Controller
{

    public function create()
    {
        $this->authorize('create');

        $kelas = Kelas::all();
        return view('siswas.create', ['kelas' => $kelas]);
    }
    public function store(RequestsStorePostRequest $request)
    {
        if (Siswa::where('nisn', $request->nisn)->first()) {
            return redirect('/kelas/ ' . $request->kelas_id . ' /show')->with('eror', 'Data Nisn Sudah Ada');
        } else {
            $validated = $request->validated();
            $siswas = new Siswa;
            $siswas->nisn = $request->nisn;
            $siswas->nama = $request->nama;
            $siswas->gender = $request->gender;
            $siswas->kelas_id = $request->kelas_id;
            $siswas->save();
            $nama_kelas = Kelas::findOrFail($request->kelas_id)->Hasil;
            return redirect('/kelas/ ' . $request->kelas_id . ' /show')->with('success', 'Tambah Data Siswa' . $nama_kelas . 'Berhasil');
        }
    }
    public function edit(int $id)
    {
        $this->authorize('edit');
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('siswas.edit', compact('siswa', 'kelas'));
    }
    public function update(UpdatePostRequest $request, $id)
    {
        $this->authorize('update');
        if (Siswa::where('nisn', $request->nisn)->where('id', '!=', $id)->first()) {
            return redirect('/kelas/ ' . $request->kelas_id . ' /show')->with('eror', 'Data Nisn Sudah Ada');
        } else {
        $siswa = Siswa::findOrFail($id);
        $siswa->nisn = $request->nisn;
        $siswa->nama = $request->nama;
        $siswa->gender = $request->gender;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->save();
        $nama_kelas = Kelas::findOrFail($request->kelas_id)->Hasil;
        return redirect('/kelas/ ' . $request->kelas_id . ' /show')->with('success', 'Update Data Siswa' . $nama_kelas . 'Berhasil');
        }
    }
    public function destroy($id)
    {
        $this->authorize('delete');
        $siswa = Siswa::findOrFail($id);
        $kelas_id = $siswa->kelas_id;
        $nama_kelas = Kelas::findOrFail($kelas_id)->Hasil;
        $siswa->delete();
        return redirect('/kelas/ ' . $kelas_id . ' /show')->with('success', 'Hapus Data Siswa' . $nama_kelas . 'Berhasil');
    }

}
