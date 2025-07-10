@extends('layouts.main')
@section('title','Edit Data Presensi')
@section('content')
    <div class="container mt-5 mb-5 ">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h1 class="text-center">
                            <i class="bi bi-person-plus-fill text-primary"></i> Form Tambah Data Presensi Siswa
                        </h1>
                        <br><br>
                        <form action="{{ route('updateAbsen', $absen->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div>
                                <select class="form-select @error('siswa_id') is-invalid @enderror"
                                aria-label="Default select example" name="siswa_id">
                                @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('siswa_id', $siswa->id) == $absen->siswa_id ? 'selected' : '' }}>
                                    {{ $siswa->nama }}</option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div>
                                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal</label>
                                <input type="date" class="form-control @error('waktu') is-invalid @enderror"
                                name="waktu" placeholder="dd-mm-yyyy" autocomplete="off" value="{{ $absen->waktu }}">
                                @error('waktu')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div>
                                <select class="form-select @error('status') is-invalid @enderror"
                                aria-label="Default select example" name="status">
                                <option selected>Status</option>
                                <option value="Hadir" {{ old('status', $absen->status) == 'Hadir' ? 'selected' : '' }}>
                                    Hadir</option>
                                    <option value="Izin" {{ old('status', $absen->status) == 'Izin' ? 'selected' : '' }}>
                                        Izin</option>
                                        <option value="Sakit" {{ old('status', $absen->status) == 'Sakit' ? 'selected' : '' }}>
                                            Sakit</option>
                                            <option value="Alpha" {{ old('status', $absen->status) == 'Alpha' ? 'selected' : '' }}>
                                                Alpha</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="form-group">
                                <label class="font-weight-bold">Keterangan</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                name="deskripsi"  autocomplete="off" value="{{ $absen->deskripsi }}">
                                @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <button type="submit" class="btn btn-md btn-primary btn-md">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
