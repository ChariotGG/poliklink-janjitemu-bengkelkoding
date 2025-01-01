@extends('Layout.header')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Riwayat Pemeriksaan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Riwayat Pemeriksaan</li>
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
                            <h3 class="card-title">Daftar Riwayat Pemeriksaan Poli</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Poli</th>
                                        <th>Nama Dokter</th>
                                        <th>Hari</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Antrian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($daftar_poli as $polri)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <!-- Nama Poli -->
                                        <td>{{ $polri->jadwalPeriksa->poli ? $polri->jadwalPeriksa->poli->nama_poli : 'Data Tidak Tersedia' }}</td>

                                        <!-- Nama Dokter -->
                                        <td>{{ $polri->jadwalPeriksa->dokter ? $polri->jadwalPeriksa->dokter->nama_dokter : 'Data Tidak Tersedia' }}</td>
                                        
                                        <td>{{ $polri->jadwalPeriksa->hari ?? 'Tidak Tersedia' }}</td>
                                        <td>{{ $polri->jadwalPeriksa->jam_mulai ?? 'Tidak Tersedia' }}</td>
                                        <td>{{ $polri->jadwalPeriksa->jam_selesai ?? 'Tidak Tersedia' }}</td>
                                        <td>{{ $polri->no_antrian }}</td>
                                        <!-- Status Pemeriksaan -->
                                        <td>{{ $polri->status_periksa }}</td>
                                        <td>
                                            <div class="d-flex justify-content">
                                                <a href="{{ url('pasien/riwayat-poli/' . $polri->id) }}" class="btn btn-primary">Detail</a>                                                 
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada riwayat pemeriksaan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
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
@endsection
