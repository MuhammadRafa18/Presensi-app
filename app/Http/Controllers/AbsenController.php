<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Siswa;
use Illuminate\View\View;
use App\Models\Kelas;
use App\Http\Requests\AbsenRequest;
use App\Http\Requests\AbsenUpdateRequest;
use App\Models\Mapel;
use Carbon\Carbon;


class AbsenController extends Controller
{
    public function index()
    {

        $kelas = Kelas::orderBy('created_at', 'desc')->paginate(3);
        return view('Presensi.menu', ['kelas' => $kelas]);


    }
    public function show($id){
        $tanggal_awal = null;
        $mapel_id = null;
        $detail = null;
        $mapel = Mapel::all();
        $kelas = Kelas::findOrFail($id);
        $today = Carbon::today()->toDateString();
            $absensi = $kelas->absensi()->with('mapel')
                        ->whereDate('waktu', $today)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return View('Presensi.show', compact('absensi', 'detail','kelas', 'tanggal_awal', 'mapel', 'mapel_id', ));
    }
    public function filter(Request $request , $id){

        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $mapel = Mapel::all();
        $request->validate([
            'mapel_id' => 'not_in:Mata Pelajaran',
        ], [
            'mapel_id.not_in' => 'Silakan pilih Mata Pelajaran'
        ]);
        $mapel_id = $request->input('mapel_id');
        $nama_mapel = Mapel::findOrFail($mapel_id)->mapel;
        $kelas = Kelas::findOrFail($id);




    $absensiQuery = $kelas->absensi()->orderBy('created_at', 'desc')->where('mapel_id',$mapel_id);


    if ($tanggal_awal) {
        $absensiQuery->where('waktu', '>=', $tanggal_awal);

    }

    if ($tanggal_akhir) {
        $absensiQuery->where('waktu', '<=', $tanggal_akhir);
    }
    if ($mapel_id) {

        $absensiQuery->where('mapel_id', $mapel_id);
        $detail = "Detail Presensi  {$kelas->hasil} Dari  Mapel {$nama_mapel} ";

    }
    if($mapel_id && $tanggal_awal && $tanggal_akhir){
        $absensiQuery->where('mapel_id', $mapel_id)
        ->where('waktu', '>=', $tanggal_awal)
        ->where('waktu', '<=', $tanggal_akhir);
        $detail = "Detail Presensi  {$kelas->hasil} Dari {$tanggal_awal} sampai {$tanggal_akhir} Pada Mapel {$nama_mapel} ";
    }


    $absensi = $absensiQuery->get();


$nisn= null;
$jumlahKehadiran = null;
    foreach ($absensi as $absen) {
        $nisn = $absen->siswa->nisn;

        if (!isset($jumlahKehadiran[$nisn])) {

            $jumlahKehadiran[$nisn] = [
                'hadir' => 0,
                'izin' => 0,
                'sakit' => 0,
                'alpha' => 0,
            ];
        }


            // Hitung jumlah kehadiran untuk siswa
            switch ($absen->status) {
                case 'Hadir':
                    $jumlahKehadiran[$nisn]['hadir']++;
                    break;
                case 'Izin':
                    $jumlahKehadiran[$nisn]['izin']++;
                    break;
                case 'Sakit':
                    $jumlahKehadiran[$nisn]['sakit']++;
                    break;
                case 'Alpha':
                    $jumlahKehadiran[$nisn]['alpha']++;
                    break;
            }

    }



    return view('Presensi.show', compact('absensi' ,'kelas','nisn'  , 'detail' ,'jumlahKehadiran', 'tanggal_awal', 'tanggal_akhir', 'mapel_id', 'mapel'));

    }

    public function create($id){
        $kelas = Kelas::FindOrFail($id);
        $siswas = $kelas->siswas()->paginate(10);
        $mapel = Mapel::all();

        return view('Presensi.create', compact( 'kelas', 'mapel', 'siswas'));

    }
    public function store(AbsenRequest $request)
{

    if (Absen::where('siswa_id', $request->siswa_id)
        ->where('kelas_id', $request->kelas_id)
        ->where('mapel_id', $request->mapel_id)
        ->where('waktu', $request->waktu)
        ->exists()) {
            return redirect('/absens/ ' . $request->kelas_id . '/kelas')->with('eror', 'Tambah Data Presensi Gagal');
        } else {



            // Looping untuk setiap siswa yang dipilih
            foreach ($request->siswa_id as $key => $siswa_id) {
                $validated = $request->validated();
        // Membuat instansi Absen baru untuk setiap siswa
        $absen = new Absen;
        $absen->siswa_id = $siswa_id; // Set siswa_id dari array
        $absen->kelas_id = $request->kelas_id; // Set kelas_id dari array
        $absen->mapel_id = $request->mapel_id;
        $absen->waktu = $request->waktu;
        $absen->status = $request->status[$key];
        $absen->deskripsi = $request->deskripsi[$key];
        $absen->save(); // Menyimpan setiap instansi Absen
    }

    // Mendapatkan nama kelas dari kelas_id terakhir yang dipilih
    $nama_kelas = Kelas::findOrFail($request->kelas_id)->Hasil;

    // Redirect kembali dengan pesan sukses
    return redirect('/absens/ ' . $request->kelas_id . '/kelas')->with('success', 'Tambah Data Presensi ' . $nama_kelas . ' Berhasil');
}}





    public function edit($id){
        $absen = Absen::FindOrFail($id);
        $kelas = $absen->kelas;
        $siswas = $kelas->siswas;
        return view('Presensi.update', compact('kelas', 'absen', 'siswas'));

    }
    public function update(AbsenUpdateRequest $request, $id){

        if (Absen::where('siswa_id', $request->siswa_id)
        ->where('kelas_id', $request->kelas_id)
        ->where('waktu', $request->waktu)
        ->where('id', '!=', $id)
        ->exists()) {
            return redirect('/absens/ ' . $request->kelas_id . ' /kelas')->with('eror', 'Update Data Presensi Gagal');
        } else {
        $validated = $request->validated();

        $absen = Absen::FindOrFail($id);
        $absen->siswa_id = $request->siswa_id;
        $absen->kelas_id = $request->kelas_id;

        $absen->waktu = $request->waktu;
        $absen->status = $request->status;
        $absen->deskripsi = $request->deskripsi;
        $absen->save();
        $nama_kelas = Kelas::findOrFail($request->kelas_id)->Hasil;
        return redirect('/absens/ '. $request->kelas_id .' /kelas')->with('success', 'Update Data Presensi' . $nama_kelas . 'Berhasil');
        }

    }
   public function destroy(Request $request) {
    $mapel_id = $request->input('mapel_id');
    $waktu = $request->input('waktu');
    $id = $request->input('id');
    if (!$mapel_id) {
        $id = $request->input('id');
        Absen::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data absen telah dihapus.');
    }
    // Hapus semua data absen yang sesuai dengan mapel_id dan waktu
    Absen::where('mapel_id', $mapel_id)
         ->where('waktu', $waktu)
         ->delete();

    // Redirect dengan pesan sukses atau ke halaman yang sesuai
    return redirect()->back()->with('success', 'Semua data absen untuk mapel ini pada waktu ini telah dihapus.');
}



}
