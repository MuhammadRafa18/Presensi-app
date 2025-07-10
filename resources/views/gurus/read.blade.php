@extends('layouts.main')
@section('title','Data Guru')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Table Guru</h1>
        <div class="text-start">

        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Guru
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered" id="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Kode Guru</th>
                            <th scope="col">Mata Pelajaran</th>
                            @can('create')
                            <th scope="col">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1 + ($gurus->currentPage() - 1) * $gurus->perPage();
                        @endphp
                        @forelse ($gurus as  $guru)
                            <tr>
                                <th>{{ $nomor++ }}</th>
                                <td>{{ $guru->nama }}</td>
                                <td>{{ $guru->gender == 'Laki-Laki' ? 'Laki-laki' : 'perempuan' }}</td>
                                <td>{{ $guru->kode_mapel }}</td>
                                <td>{{ $guru->mapel->mapel }}</td>
                            @can('create')
                                <td class="text-center">
                                    <form action="{{ route('destroyGuru', $guru->id) }}" method="POST">
                                        <a href="{{ route('editGuru', $guru->id) }}" class="btn btn-sm btn-dark">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>

                                    </form>
                                </td>
                             @endcan
                            </tr>
                            {{-- alert data --}}
                        @empty
                            <div class="alert alert-danger">
                                Data Guru belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{ $gurus->links() }}
            </div>
        </div>
    </div>
@endsection
