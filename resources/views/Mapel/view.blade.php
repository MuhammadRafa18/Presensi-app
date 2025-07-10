@extends('layouts.main')
@section('title','Data Mata Pelajaran')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Table Mapel</h1>
        <div class="text-start">
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Mapel
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Mata Pelajaran</th>
                            @can('create')

                            <th scope="col">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1 + ($mapel->currentPage() - 1) * $mapel->perPage();
                        @endphp
                        @forelse ($mapel as  $m)
                            <tr>
                                <th>{{ $nomor++ }}</th>
                                <td>{{ $m->mapel }}</td>
                                @can('create')

                                <td class="text-center">

                                    <form action="{{ route('destroyMapel', $m->id) }}" method="POST">
                                        <a href="{{ route('editMapel', $m->id) }}" class="btn btn-sm btn-dark">Edit</a>
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
                                Data Mapel belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{ $mapel->links() }}
            </div>
        </div>
    </div>
@endsection
