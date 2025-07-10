<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
   /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Siswa([
            'nisn' => $row[1],
            'nama' => $row[2],
            'gender' => $row[3],
            'kelas_id' => $row[4],

        ]);
    }
}
