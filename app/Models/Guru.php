<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mapel;

class Guru extends Model
{
    use HasFactory;
        public function mapel()
        {
            return $this->belongsTo(Mapel::class);
        }
        protected $fillable = [
            'nama',
            'gender',
            'kode_mapel',
            'mapel_id'
        ];
}
