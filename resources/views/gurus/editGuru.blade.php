@extends('layouts.main')
@section('title','Edit Data Guru')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">


                        <h1 class="text-center">Form Tambah Data Guru</h1>
                        <br><br>
                        <form action="{{ route('updateGuru', $gurus->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Guru</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" autocomplete="off" value="{{ old('nama', $gurus->nama) }}">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div>
                                <select class="form-select @error('gender') is-invalid @enderror"
                                    aria-label="Default select example" name="gender">
                                    <option value="Laki-Laki"
                                        {{ old('gender', $gurus->gender) == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan"
                                        {{ old('gender', $gurus->gender) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="font-weight-bold">Kode Guru</label>
                                <input type="text" class="form-control @error('kode_mapel') is-invalid @enderror"
                                    name="kode_mapel" autocomplete="off"
                                    value="{{ old('kode_mapel', $gurus->kode_mapel) }}">
                                @error('kode_mapel')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div>
                                    <select class="form-select @error('mapel_id') is-invalid @enderror"
                                        aria-label="Default select example" name="mapel_id">
                                        @foreach ($mapel as $m)
                                        <option value="{{ $m->id }}" {{ $m->id == $gurus->mapel_id ? 'selected' : '' }}>{{ $m->mapel }}
                                        @endforeach
                                    </select>
                                @error('mapel_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <button type="submit" class="btn btn-md btn-primary btn-md ">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
