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
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Profile Dokter</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('dokter.profile.update')}}" method="POST">
                            @csrf
                            {{-- @php
                                dd(session()->all())
                            @endphp --}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="namapoli">Nama Dokter</label>
                                    <input type="text" value="{{ session('nama_dokter') }}" name="nama_dokter" class="form-control " >
                                </div>
                                <div class="form-group">
                                    <label for="namapoli">Alamat</label>
                                    <input type="text" value="{{ session('alamat') }}" name="alamat" class="form-control " >
                                </div>
                                <div class="form-group">
                                    <label for="namapoli">No Hp</label>
                                    <input type="text" value="{{ session('no_hp') }}" name="no_hp" class="form-control " >
                                </div>
                                <input type="hidden" name="id" value={{ session('id') }}>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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