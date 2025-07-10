<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mapel;

class Absen extends Model
{
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function getHasilattribute()
    {
        return $this->kelas . ' ' . $this->jurusan->jurusan . ' ' . $this->kategory;
    }
    public function mapel(){
        return $this->belongsTo(Mapel::class);
    }
    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'mapel_id',
        'waktu',
        'status',
        'deskripsi'
    ];
}
