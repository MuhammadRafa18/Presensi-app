<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use Illuminate\View\View;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $this->authorize('presensi');

        $kelas = Kelas::with(['jurusan', 'guru'])->orderBy('created_at', 'desc')->paginate('3');
        return view('Kelas.table', compact('kelas'));
    }
    public function create()
    {
        $this->authorize('create');
        $jurusans = Jurusan::all();
        $guru = Guru::all();
        return view('Kelas.createK', compact('jurusans', 'guru'));
    }
    public function input(KelasRequest $request)
    {
        if (Kelas::where('kelas', $request->kelas)->where('jurusan_id', $request->jurusan_id)->where
        ('kategory', $request->kategory)->first()) {
            return redirect('/kelas')->with('eror', 'Data kelas sudah ada');
        } else {
            $validated = $request->validated();
            $kelass = new Kelas;
            $kelass->guru_id = $request->guru_id;
            $kelass->kelas = $request->kelas;
            $kelass->jurusan_id = $request->jurusan_id;
            $kelass->kategory = $request->kategory;
            $kelass->save();

            return redirect('/kelas')->with('success', 'Tambah Data Kelas Berhasil');
        }
    }
    public function edit(int $id)
    {
        $this->authorize('edit');

        $kelass = Kelas::FindOrFail($id);
        $jurusans = Jurusan::all();
        $guru = Guru::all();
        return view('Kelas.editK', ['kelass' => $kelass, 'jurusans' => $jurusans, 'guru' => $guru]);
    }
    public function show($id)
    {
        $this->authorize('presensi');

        $kelas = Kelas::with('siswas')->findOrFail($id);
        $siswas = $kelas->siswas()->orderBy('created_at', 'desc')->paginate(3);
        return View('kelas.show', compact('siswas', 'kelas'));
    }
    public function update(UpdateKelasRequest $request, $id)
    {
        $this->authorize('update');
        if (Kelas::where('kelas', $request->kelas)->where('jurusan_id', $request->jurusan_id)->where
        ('kategory', $request->kategory)->where('id', '!=', $id)->first()) {
            return redirect('/kelas')->with('eror', 'Data kelas sudah ada');
        } else {
        $kelass = Kelas::FindOrFail($id);
        $kelass->guru_id = $request->guru_id;
        $kelass->kelas = $request->kelas;
        $kelass->jurusan_id = $request->jurusan_id;
        $kelass->kategory = $request->kategory;
        $kelass->save();

        return redirect('/kelas')->with('success', 'Update Data Kelas Berhasil');
        }
    }
    public function destroy($id)
    {
        $this->authorize('delete');
        $kelass = Kelas::with(['jurusan', 'guru'])->findOrFail($id);
        $kelass->delete();
        return redirect('/kelas')->with('success', 'Hapus Data kelas Berhasil');
    }
}
