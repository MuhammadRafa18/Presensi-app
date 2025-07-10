<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurusanRequest;
use App\Http\Requests\UpdateJurusanRequest;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Ramsey\Uuid\Type\Integer;

class JurusanController extends Controller
{
    public function tampilanj()
    {
        $this->authorize('create');

        $jurusan = Jurusan::orderBy('created_at', 'desc')->paginate(5);
        return view('Jurusan.createj', ['jurusan' => $jurusan]);
    }
    public function createj()
    {
        $this->authorize('create');

        return view('Jurusan.createj');
    }
    public function storej(JurusanRequest $request)
    {
        if( Jurusan::where('jurusan', $request->jurusan)->first()){
         return redirect('jurusan')->with('eror','Data Jurusan Sudah Ada');
        }else{
        $validated = $request->validated();
        $jurusan = new Jurusan;
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();

        return redirect('/jurusan')->with('success', 'Tambah Data Jurusan Berhasil');
        }
    }
    public function editj(int $id)
    {
        $this->authorize('edit');
        $jurusa = Jurusan::findOrFail($id);
        return view('Jurusan.editj', compact('jurusa'));
    }
    public function updatej(UpdateJurusanRequest $request, $id)
    {
        $this->authorize('update');
        if(Jurusan::where('jurusan', $request->jurusan)->where('id' != '$id')){
            return redirect('jurusan')->with('eror','Data Jurusan Sudah Ada');
    }else{
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();
        return redirect('/jurusan')->with('success', 'Update Data Jurusan Berhasil');
    }
    }
    public function destroyj($id)
    {
        $this->authorize('delete');
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect('/jurusan')->with('success', 'Data Jurusan  Berhasil di Hapus');
    }
}
