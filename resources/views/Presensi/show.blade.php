@extends('layouts.main')
@section('title','Presensi')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Table Presensi Kelas  {{ $kelas->hasil }}</h1>
        <form action="{{ route('filterAbsensi', $kelas->id) }}" method="GET">
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
    <div style="margin-top: 10px;">
        <button type="submit">Filter</button>
    </div>
</form>

        <br>

        <div class="text-start">
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                @if ($detail)
                {{ $detail }}

                @else
                Detail Presensi Kelas {{ $kelas->hasil }}
                @endif
            </div>
            <div class="card-body ">
                <div class="table-responsive">

                    <table class="table table-bordered ">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nisn</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Kelas</th>
                                @if ($mapel_id && $tanggal_awal && $tanggal_akhir)
                                <th scope="col">Hadir</th>
                                <th scope="col">Izin</th>
                                <th scope="col">Sakit</th>
                                <th scope="col">Alpha</th>
                                @else
                                <th scope="col">Waktu Absen</th>
                                <th scope="col">Status</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $siswaCetak = [];
                            @endphp
                        @if($absensi->isEmpty())
                        <div class="alert alert-danger">
                            Data Presensi tidak tersedia.
                        </div>
                        @else
                        @forelse ($absensi as $a)
                        @php
                            $nisn = $a->siswa->nisn;
                            @endphp
                                <tr>
                                    @if ($mapel_id && $tanggal_awal && $tanggal_akhir)
                                    @if (!isset($siswaCetak[$nisn]))
                                    @php
                                        $siswaCetak[$nisn] = true;
                                    @endphp
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $a->siswa->nisn }}</td>
                                    <td>{{ $a->siswa->nama }}</td>
                                    <td>{{ $a->mapel->mapel }}</td>
                                    <td>{{ $a->siswa->gender }}</td>
                                    <td>{{ $a->kelas->hasil }}</td>
                                    <td>{{ $jumlahKehadiran[$a->siswa->nisn]['hadir'] }}</td>
                                    <td>{{ $jumlahKehadiran[$a->siswa->nisn]['izin'] }}</td>
                                    <td>{{ $jumlahKehadiran[$a->siswa->nisn]['sakit'] }}</td>
                                    <td>{{ $jumlahKehadiran[$a->siswa->nisn]['alpha'] }}</td>
                                    @endif
                                    @else
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $a->siswa->nisn }}</td>
                                    <td>{{ $a->siswa->nama }}</td>
                                    <td>{{ $a->mapel->mapel }}</td>
                                    <td>{{ $a->siswa->gender }}</td>
                                    <td>{{ $a->kelas->hasil }}</td>
                                    <td>{{ $a->waktu }}</td>
                                    <td>{{ $a->status }}</td>
                                    <td>{{ $a->deskripsi }}</td>
                                    @endif
                                    @if (!$mapel_id || !$tanggal_awal || !$tanggal_akhir)
                                    <td class="text-center">
                                        <a href="{{ route('editAbsen', $a->id) }}" class="btn btn-sm btn-dark">Edit</a>
                                        @if(!$mapel_id)
                                        <form action="{{ route('deleteAbsen') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $a->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus  data absen ini?')">Hapus Data</button>
                                        </form>
                                        @endif
                                    </td>

                                    @endif
                                </tr>
                                {{-- alert data --}}
                            @empty
                                <div class="alert alert-danger">
                                    Data Presensi Tidak  Tersedia.
                                </div>
                            @endforelse
                            @endif


                        </tbody>

                    </table>

                    @if ($mapel_id && !$tanggal_awal && !$tanggal_akhir)

                    <form action="{{ route('deleteAbsen') }}" method="POST">
                        @csrf
                        @foreach ($absensi as $a)
                        <input type="hidden" name="mapel_id" value="{{ $a->mapel_id }}">
                        <input type="hidden" name="waktu" value="{{ $a->waktu }}">
                        @endforeach
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus semua data absen untuk mapel ini pada waktu ini?')">Hapus Semua Data Absen</button>
                    </form>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection
