<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapelRequest;
use App\Http\Requests\UpdateMapelRequest;
use Illuminate\Http\Request;
use  Illuminate\View\View;
use App\Models\Mapel;
use Illuminate\Auth\Events\Validated;

class MapelController extends Controller
{
    public function tampilanM()
    {

        $this->authorize('presensi');

        $mapel = Mapel::orderBy('created_at', 'desc')->paginate('4');
        return View('Mapel.view', compact('mapel'));
    }
    public function createM()
    {
        $this->authorize('create');

        return View('Mapel.createM');
    }
    public function storeM(MapelRequest $request)
    {
        if(Mapel::where('mapel',$request->mapel)->first()){
            return redirect('/mapel')->with('eror', ' Data Mata Pelajaran Sudah ada');
        } else {
        $Validated = $request->validated();
        $mapel = new Mapel;
        $mapel->mapel = $request->mapel;
        $mapel->save();
        return redirect('/mapel')->with('success', 'Tambah Data Mata Pelajaran');
        }
    }
    public function editM(int $id)
    {
        $this->authorize('edit');
        $mapel = Mapel::FindOrFail($id);
        return View('Mapel.editM', compact('mapel'));
    }
    public function updateM(UpdateMapelRequest $request, $id)
    {
        $this->authorize('update');
        if(Mapel::where('mapel',$request->mapel)->where('id', '!=', $id)->first()){
            return redirect('/mapel')->with('eror', ' Data Mata Pelajaran Sudah ada');
        } else {
        $mapel = Mapel::FindOrFail($id);
        $mapel->mapel = $request->mapel;
        $mapel->save();
        return redirect('/mapel')->with('success', 'Update Data Mata Pelajaran');
        }
    }
    public function destroyM($id)
    {
        $this->authorize('delete');
        $mapel = Mapel::FindOrFail($id);
        $mapel->delete();
        return redirect('/mapel')->with('success', 'Hapus Data Mata Pelajaran');
    }
}
