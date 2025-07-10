    @extends('layouts.main')
    @section('title','Table Kelas Presensi')
    @section('content')
        <div class="container-fluid px-4">
            <h1 class="mt-4">Table Kelas</h1>
            <div class="text-start">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Kelas
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-bordered" id="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Wali Kelas</th>
                                    <th scope="col" style="width: 250px;">Kelas</th>
                                    <th scope="col" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = 1 + ($kelas->currentPage() - 1) * $kelas->perPage();
                                @endphp
                               @forelse ($kelas as $k)
                               <tr>
                                   <th>{{ $nomor++ }}</th>
                                   <th>{{ $k->guru->nama }}</th>
                                   <td>{{ $k->Hasil }}</td>
                                   <td class="text-center">
                                  <a href="{{ route('show', $k->id) }}" class="btn btn-sm btn-dark">Show</a>
                                   </td>
                               </tr>
                           @empty
                               <div class="alert alert-danger">
                                   Data Kelas belum Tersedia.
                               </div>
                           @endforelse

                            </tbody>
                        </table>
                        {{ $kelas->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endsection



