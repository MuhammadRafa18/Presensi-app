@extends('layouts.main')
@section('title','Tambah Data Presensi')
@section('content')
    <div class="container mt-5 mb-5 ">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h1 class="text-center">
                            <i class="bi bi-person-plus-fill text-primary"></i> Tambah Data Presensi Siswa
                        </h1>
                        <br><br>
                        <div class="table-responsive">
                            <form action="{{ route('storeAbsen') }}" method="POST">
                                @csrf
                            <div>
                                <select class="form-select @error('mapel_id') is-invalid @enderror" aria-label="Default select example" name="mapel_id">
                                    <option selected>Mata Pelajaran</option>
                                    @foreach ($mapel as $m)
                                        <option value="{{ $m->id }}">{{ $m->mapel }}</option>
                                    @endforeach
                                </select>
                                @error('mapel_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                                <div class="form-group">
                                    <input type="date" class="form-control @error('waktu') is-invalid @enderror" name="waktu" placeholder="dd-mm-yyyy" autocomplete="off" value="">
                                    @error('waktu')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div><br>

                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nisn</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $nomor = 1 + ($siswas->currentPage() - 1) * $siswas->perPage();
                                @endphp
                                @forelse ($siswas as $a)

                                <tr>
                                    <th>{{ $nomor++ }}</th>
                                    <td>{{ $a->nisn }}</td>
                                    <td><input type="hidden" name="siswa_id[]" value="{{ $a->id }}">
                                    {{ $a->nama }}</td>
                                    <td>{{ $a->gender }}</td>
                                    <td><input type="hidden" name="kelas_id" value="{{ $a->kelas->id }}">
                                  {{ $a->kelas->hasil }}</td>

                                    <td>
                                        <div>
                                            <select class="form-select @error('status.*') is-invalid @enderror" aria-label="Default select example" name="status[]">
                                                <option selected>Status</option>
                                                <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                                <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                                                <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                                <option value="Alpha" {{ old('status') == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                                            </select>
                                            @error('status.*')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('deskripsi.*') is-invalid @enderror" name="deskripsi[]" placeholder="" autocomplete="off" value="">
                                            @error('deskripsi.*')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </td>

                                </tr>

                                        {{-- alert data --}}
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Siswa belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <td class="text-center">
                                <button type="submit" class="btn btn-md btn-primary btn-md">SIMPAN</button>
                            </td>
                            {{ $siswas->links() }}
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

