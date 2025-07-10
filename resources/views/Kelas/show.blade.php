@extends('layouts.main')
@section('title','Data Siswa')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Table Kelas {{ $kelas->hasil }}</h1>
        <div class="text-start">
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Detail Kelas {{ $kelas->hasil }}
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nisn</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Kelas</th>
                            @can('create')

                            <th scope="col">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1 + ($siswas->currentPage() - 1) * $siswas->perPage();
                        @endphp
                        @forelse ($siswas as  $siswa)
                            <tr>
                                <th>{{ $nomor++ }}</th>
                                <td>{{ $siswa->nisn }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->gender == 'Laki-Laki' ? 'Laki-laki' : 'perempuan' }}</td>
                                <td>{{ $siswa->kelas->hasil }}</td>
                              @can('create')

                              <td class="text-center">


                                  <form action="{{ route('destroy', $siswa->id) }}" method="POST">
                                    <a href="{{ route('edit', $siswa->id) }}" class="btn btn-sm btn-dark">Edit</a>
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
                                Data Siswa belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{ $siswas->links() }}
            </div>
        </div>
    </div>
@endsection
