<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Guru;
use Illuminate\Http\Request;
use App\Http\Requests\GuruStoreRequest;
use App\Http\Requests\UpdateGuruRequest;
use Illuminate\View\View;

class GuruController extends Controller
{
    public function read()
    {
        $this->authorize('presensi');

        $gurus = Guru::with('mapel')->orderby('created_at', 'desc')->paginate(10);

        return view('gurus.read', compact('gurus'));
    }
    public function create()
    {
        $this->authorize('create');

        $mapel = Mapel::all();
        return view('gurus.createGuru', compact('mapel'));
    }
    public function store(GuruStoreRequest $request)
    {

        if (Guru::where('kode_mapel', $request->kode_mapel)->first()) {
            return redirect('/read')->with('eror', 'Data Kode Guru Sudah Terpakai');
        } else {
            $validated = $request->validated();
            $gurus = new Guru;
            $gurus->nama = $request->nama;
            $gurus->gender = $request->gender;
            $gurus->kode_mapel = $request->kode_mapel;
            $gurus->mapel_id = $request->mapel_id;
            $gurus->save();

            return redirect('/read')->with('success', 'Tambah Data Guru Berhasil');
        }
    }
    public function edit(int $id)
    {
        $this->authorize('edit');

        $gurus = Guru::FindOrFail($id);
        $mapel = Mapel::all();
        return View('gurus.editGuru', compact('gurus', 'mapel'));
    }
    public function update(UpdateGuruRequest $request, $id)
    {
        $this->authorize('update');
        if (Guru::where('kode_mapel', $request->kode_mapel )->where('id', '!=', $id)->first()) {
            return redirect('/read')->with('eror', 'Data Kode Guru Sudah Terpakai');
        } else {
        $gurus = Guru::FindOrFail($id);
        $gurus->nama = $request->nama;
        $gurus->gender = $request->gender;
        $gurus->kode_mapel = $request->kode_mapel;
        $gurus->mapel_id = $request->mapel_id;
        $gurus->save();


        return redirect('/read')->with('success', 'Update Data Guru Berhasil');
        }
    }
    public function destroy($id)
    {
        $this->authorize('delete');
        $gurus = Guru::FindOrFail($id);
        $gurus->delete();
        return redirect('/read')->with('success', 'Hapus Data Guru Berhasil');
    }
}
