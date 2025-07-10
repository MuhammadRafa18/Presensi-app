@extends('layouts.main')
@section('title','Tambah Data Siswa')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h1 class="text-center">
                            <i class="bi bi-person-plus-fill text-primary"></i> Form Tambah Data Siswa
                        </h1>
                        <br><br>
                        <form action="{{ route('store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nisn</label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                    name="nisn" autocomplete="off" value="{{ old('nisn') }}">
                                @error('nisn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" autocomplete="off" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div>
                                <select class="form-select @error('gender') is-invalid @enderror"
                                    aria-label="Default select example" name="gender">
                                    <option selected>Pilih Gender--</option>
                                    <option value="Laki-Laki" {{ old('gender') == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div>
                                <select class="form-select @error('kelas_id') is-invalid @enderror"
                                    aria-label="Default select example" name="kelas_id">
                                    <option selected>Pilih kelas anda--</option>
                                    @forelse ($kelas as $k)
                                        <option value="{{ $k->id }}">
                                            {{ $k->hasil }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('kelas_id')
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
