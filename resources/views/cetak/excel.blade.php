@extends('layouts.main')
@section('title','Laporan Presensi')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Export Presensi</h1>
        <form action="{{ route('filterP') }}" method="GET">
    <label for="tanggal_awal">Tanggal Awal:</label>
    <input type="date" id="tanggal_awal" name="tanggal_awal">
    <label for="tanggal_akhir">Tanggal Akhir:</label>
    <input type="date" id="tanggal_akhir" name="tanggal_akhir">
    <br><br>
    <div >
        <select class="form-select @error('mapel_id') is-invalid @enderror" aria-label="Default select example" name="mapel_id">
            <option selected >Mata Pelajaran</option>
            @foreach ($mapel as $m)
                <option value="{{ $m->id }}">{{ $m->mapel }}</option>
            @endforeach
        </select>
        @error('mapel_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div >
        <select class="form-select @error('kelas_id') is-invalid @enderror" aria-label="Default select example" name="kelas_id">
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->Hasil }}</option>
            @endforeach
        </select>
        @error('kelas_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div style="margin-top: 10px;">
        <button type="submit">Filter</button>
    </div>
</form>

        <br>

        <div class="text-start">
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> @if ($detail)
                {{ $detail }}

                @else
                Cetak Laporan
                @endif
            </div>
            <div class="card-body ">
                <div class="table-responsive">

                    <table id="tabledata" class="table table-bordered ">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nisn</th>
                                <th scope="col">Nama</th>
                                @if ($mapel_id && $tanggal_awal && $tanggal_akhir)
                                <th scope="col">Gender</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Hadir</th>
                                <th scope="col">Izin</th>
                                <th scope="col">Sakit</th>
                                <th scope="col">Alpha</th>
                                @else
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Waktu Absen</th>
                                <th scope="col">Status</th>
                                <th scope="col">Keterangan</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $siswaCetak = []; // Array untuk melacak data yang sudah dicetak
                            @endphp
                            @forelse ($absensi as $a)
                            @php
                                $nisn = $a->siswa->nisn;
                            @endphp
                            @if (!$mapel_id || !$tanggal_awal || !$tanggal_akhir || !isset($siswaCetak[$nisn]))
                            @php
                                $siswaCetak[$nisn] = true; // Tandai data sebagai sudah dicetak
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->siswa->nisn }}</td>
                                <td>{{ $a->siswa->nama }}</td>
                                @if ($mapel_id && $tanggal_awal && $tanggal_akhir)
                                <td>{{ $a->siswa->gender }}</td>
                                <td>{{ $a->kelas->hasil }}</td>
                                <td>{{ $jumlahKehadiran[$a->siswa->nisn]['hadir'] }}</td>
                                <td>{{ $jumlahKehadiran[$a->siswa->nisn]['izin'] }}</td>
                                <td>{{ $jumlahKehadiran[$a->siswa->nisn]['sakit'] }}</td>
                                <td>{{ $jumlahKehadiran[$a->siswa->nisn]['alpha'] }}</td>
                                @else
                                <td>{{ $a->mapel->mapel }}</td>
                                <td>{{ $a->siswa->gender }}</td>
                                <td>{{ $a->kelas->hasil }}</td>
                                <td>{{ $a->waktu }}</td>
                                <td>{{ $a->status }}</td>
                                <td>{{ $a->deskripsi }}</td>
                                @endif
                            </tr>
                            {{-- alert data --}}
                            @endif
                            @empty
                            <div class="alert alert-danger">
                                Data Presensi Tidak Tersedia.
                            </div>
                            @endforelse
                        </tbody>



                    </table>


                </div>


            </div>
        </div>
    </div>
@endsection
