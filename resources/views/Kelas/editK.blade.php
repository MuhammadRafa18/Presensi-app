@extends('layouts.main')
@section('title','Edit Data Kelas')
@section('content')
    <div class="container mt-3 mb-3 ">
        <div class="row">
            <div class="col-md-12 " style="">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">


                        <h1 class="text-center">Form Update Data Kelas</h1>
                        <br><br>
                        <form action="{{ route('updateKelas', $kelass->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div>
                                <select class="form-select @error('guru_id') is-invalid @enderror"
                                    aria-label="Default select example" name="guru_id">
                                    <option value="{{ $kelass->guru->id }}">{{ $kelass->guru->nama }}</option>
                                    @foreach ($guru as $g)
                                        <option value="{{ $g->id }}">
                                            {{ $g->nama }}</option>
                                    @endforeach
                                </select>
                                @error('guru_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div>
                                <select class="form-select @error('kelas') is-invalid @enderror"
                                    aria-label="Default select example" name="kelas">
                                    <option value="{{ $kelass->id }}">{{ $kelass->kelas }}</option>
                                    <option value="10" {{ old('kelas', $kelass->kelas) == '10' ? 'selected' : '' }}>
                                        10</option>
                                    <option value="11" {{ old('kelas', $kelass->kelas) == '11' ? 'selected' : '' }}>
                                        11</option>
                                    <option value="12" {{ old('kelas', $kelass->kelas) == '12' ? 'selected' : '' }}>
                                        12</option>

                                </select>
                                @error('kelas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div>
                                <select class="form-select @error('jurusan_id') is-invalid @enderror"
                                    aria-label="Default select example" name="jurusan_id">
                                    <option value="{{ $kelass->jurusan->id }}">{{ $kelass->jurusan->jurusan }}</option>
                                    @foreach ($jurusans as $j)
                                        <option value="{{ $j->id }}">
                                            {{ $j->jurusan }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="font-weight-bold">Kategory</label>
                                <input type="number" class="form-control @error('kategory') is-invalid @enderror"
                                    name="kategory" autocomplete="off" value="{{ old('kategory', $kelass->kategory) }}">
                                @error('kategory')
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
