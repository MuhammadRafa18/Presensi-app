@extends('layouts.main')
@section('title','Edit Data Siswa')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h1 class="text-center">Form Edit Data siswa</h1>
                        {{-- <a href="{{ route('show') }}">Kembali</a> --}}
                        <form action="{{ route('update', $siswa->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nisn</label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                    name="nisn" autocomplete="off" value="{{ old('nisn', $siswa->nisn) }}">
                            </div>
                            @error('nisn')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" autocomplete="off" value="{{ old('nama', $siswa->nama) }}">
                            </div>
                            @error('nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <br>
                            <div>
                                <select class="form-select @error('gender') is-invalid @enderror"
                                    aria-label="Default select example" name="gender">
                                    <option value="Laki-Laki"
                                        {{ old('gender', $siswa->gender) == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan"
                                        {{ old('gender', $siswa->gender) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                            @error('gender')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <br>
                            <div>
                                @foreach ($kelas as $k)
                                    @if ($k->id === $siswa->kelas_id)
                                        <input type="hidden" name="kelas_id" value="{{ $k->id }}">
                                    @endif
                                @endforeach
                            </div>




                            <br>


                            <button type="submit" class="btn btn-md btn-primary btn-md ">Update Data</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
