@extends('layouts.main')
@section('title','Tambah Data Jurusan')

@section('content')
    <div class="container mt-3 mb-3 ">
        <div class="row">
            <div class="col-md-12 " style="">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">


                        <h1 class="text-center">Form Tambah Data Jurusan</h1>
                        <br><br>
                        <form action="{{ route('storeJurusan') }}" method="POST">

                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Jurusan</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                    name="jurusan" autocomplete="off" value="{{ old('jurusan') }}">
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
    <div class="container-fluid px-4">
        <h1 class="mt-4">Jurusan</h1>
        <div class="text-start">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Jurusan
                </div>
                <div class="card-body table-responsive">

                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col" style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $nomor = 1 + ($jurusan->currentPage() - 1) * $jurusan->perPage();
                            @endphp
                            @forelse ($jurusan as  $juru)
                                <tr>
                                    <th>{{ $nomor++ }}</th>
                                    <td>{{ $juru->jurusan }}</td>
                                    <td class="text-center">

                                        <form action="{{ route('destroyJurusan', $juru->id) }}" method="POST">
                                            <a href="{{ route('editJurusan', $juru->id) }}"
                                                class="btn btn-sm btn-dark">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>

                                        </form>
                                    </td>

                                </tr>
                                {{-- alert data  --}}
                            @empty
                                <div class="alert alert-danger">
                                    Data Jurusan belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $jurusan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
