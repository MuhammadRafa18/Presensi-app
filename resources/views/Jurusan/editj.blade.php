@extends('layouts.main')
@section('title','Edit Data Jurusan')

@section('content')
    <div class="container mt-3 mb-3 ">
        <div class="row">
            <div class="col-md-12 " style="">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">


                        <h1 class="text-center">Form Tambah Data Jurusan</h1>
                        <br><br>
                        <form action="{{ route('updateJurusan', $jurusa->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Jurusan</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                    name="jurusan" autocomplete="off" value="{{ old('jurusan', $jurusa->jurusan) }}">
                                @error('jurusan')
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
