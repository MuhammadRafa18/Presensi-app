<?php

namespace App\Http\Controllers;
use App\Models\Absen;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Mapel;
use Carbon\Carbon;


class PresensiController extends Controller
{
    public function cetak(){

        $tanggal_awal = null;
        $mapel_id = null;
        $kelas_id = null;
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $detail = null;
        $today = Carbon::today()->toDateString();
        $absensi = Absen::with('mapel' , 'kelas')
                    ->whereDate('waktu', $today)
                    ->orderBy('created_at', 'desc')
                    ->get();


       return view('cetak.excel', compact('absensi', 'mapel', 'tanggal_awal', 'mapel_id', 'kelas_id', 'kelas', 'detail'));

    }
    public function filterP(Request $request ){

        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $request->validate([
            'mapel_id' => 'not_in:Mata Pelajaran',
        ], [
            'mapel_id.not_in' => 'Silakan pilih Mata Pelajaran',
        ]);
        $mapel_id = $request->input('mapel_id');
        $kelas_id = $request->input('kelas_id');
        $nama_mapel = Mapel::findOrFail($mapel_id)->mapel;



  if($kelas_id){
      $kelas1 = Kelas::findOrFail($kelas_id);
      $absensiQuery = $kelas1->absensi()->orderBy('created_at', 'desc')->where('mapel_id',$mapel_id);
    }else{
      $absensiQuery = Absen::orderBy('created_at', 'desc')->where('mapel_id',$mapel_id);

    }


    if ($tanggal_awal) {
        $absensiQuery->where('waktu', '>=', $tanggal_awal);

    }

    if ($tanggal_akhir) {
        $absensiQuery->where('waktu', '<=', $tanggal_akhir);
    }
    if ($mapel_id) {

        $absensiQuery->where('mapel_id', $mapel_id);
        $detail = "Detail Presensi  {$kelas1->hasil} Dari  Mapel {$nama_mapel} ";

    }
    if($mapel_id && $tanggal_awal && $tanggal_akhir){
        $absensiQuery->where('mapel_id', $mapel_id)
        ->where('waktu', '>=', $tanggal_awal)
        ->where('waktu', '<=', $tanggal_akhir);
        $detail = "Detail Presensi  {$kelas1->hasil} Dari {$tanggal_awal} sampai {$tanggal_akhir} Pada Mapel {$nama_mapel} ";
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



    return view('cetak.excel', compact('absensi' ,'kelas','nisn' , 'mapel','detail' ,'jumlahKehadiran', 'tanggal_awal', 'tanggal_akhir', 'mapel_id', 'mapel' ,'kelas_id'));
    }


}
