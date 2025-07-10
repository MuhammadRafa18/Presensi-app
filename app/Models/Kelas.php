<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Guru;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelass';
    public function getHasilattribute()
    {
        return $this->kelas . ' ' . $this->jurusan->jurusan . ' ' . $this->kategory;
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function absensi()
    {
        return $this->hasMany(Absen::class);
    }
    protected $fillable = [
        'guru_id',
        'kelas',
        'jurusan_id',
        'kategory'
    ];
}
