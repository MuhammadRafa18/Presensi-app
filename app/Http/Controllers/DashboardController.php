<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hitung_jurusan = Jurusan::count();
        $hitung_kelas = Kelas::count();
        $hitung_siswa = Siswa::count();
        $hitung_mapel = Mapel::count();
        $hitung_guru = Guru::count();

        return view('dashboard.jumlah',compact('hitung_jurusan','hitung_kelas','hitung_siswa','hitung_mapel','hitung_guru'));

    }
}
