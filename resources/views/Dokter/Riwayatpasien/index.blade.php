@extends('Layout.header')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Validation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Validation</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Riwayat Pasien</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">

                                    {{-- <div class="input-group-append">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahJadwal">
                                            <i class="fas fa-plus"></i> Tambah Jadwal
                                        </button>                                        
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pasien</th>
                                        <th>Alamat</th>
                                        <th>No. KTP</th>
                                        <th>No. Telepon</th>
                                        <th>No. RM</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @forelse ($jadwal->where('id_dokter',session()->get('id')) as $polri)
                                    <tr>

                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$polri->dokter->nama_dokter}}</td>
                                        <td>{{$polri->hari}}</td>
                                        <td>{{$polri->jam_mulai}}</td>
                                        <td>{{$polri->jam_selesai}}</td>
                                        <td>
                                            @if($polri->status == 1)
                                                Aktif
                                            @elseif($polri->status == 2)
                                                Tidak Aktif
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content">
                                                <a href="{{ url('dokter/jadwal-periksa/' . $polri->id) }}/edit" class="btn btn-primary">Edit</a>
                                                <form action="{{ url('dokter/jadwal-periksa/' . $polri->id) }}/delete" method="POST" style="margin-left: 10px;">
                                                    @csrf
                                                    <button class="btn btn-danger" onclick="confirmDelete('{{ url('dokter/jadwal-periksa/' . $polri->id) }}/delete')">Hapus</button>                                                    </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>Kosong</td>
                                    </tr>
                                    @endforelse
                                
                                </tbody> --}}
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal Tambah Jadwal -->
{{-- <div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahJadwalLabel">Tambah Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('dokter.jadwal-periksa.post')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaDokter">Nama Dokter</label>
                        <input type="hidden" name="id_dokter" value="{{session()->get('id')}}">
                        <input type="text"  class="form-control" value="{{session()->get('nama_dokter')}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" class="form-control" required>
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jamMulai">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" id="jamMulai" required>
                    </div>
                    <div class="form-group">
                        <label for="jamSelesai">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" id="jamSelesai" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

@endsection