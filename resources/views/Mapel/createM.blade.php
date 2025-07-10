@extends('layouts.main')
@section('title','Tambah Data Mata Pelajaran')
@section('content')
    <div class="container mt-5 mb-5 ">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">

                        <h1 class="text-center">
                            <i class="bi bi-person-plus-fill text-primary"></i> Form Tambah Data Mata Pelajaran
                        </h1>

                        <br><br>
                        <form action="{{ route('storeMapel') }}" method="POST">

                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Mata Pelajaran</label>
                                <input type="text" class="form-control @error('mapel') is-invalid @enderror"
                                    name="mapel" autocomplete="off" value="{{ old('mapel') }}">
                                @error('mapel')
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
