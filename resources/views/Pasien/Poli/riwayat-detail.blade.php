@extends('Layout.header')

@section('main')
<div class="content-wrapper" style="min-height: 518.667px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pemeriksaan Poli</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Poli</a></li>
                        <li class="breadcrumb-item active">Detail Pemeriksaan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Detail Pemeriksaan</h3>
                </div>
                <div class="card-body">
                    <center>
                        <!-- Menampilkan Nama Poli -->
                        <h5>Nama Poli</h5>
                        <p>{{ $poli->nama_poli ?? 'Tidak Tersedia' }}</p>
                        <hr>

                        <!-- Menampilkan Nama Dokter -->
                        <h5>Nama Dokter</h5>
                        <p>{{ $dokter->nama_dokter ?? 'Tidak Tersedia' }}</p>
                        <hr>

                        <!-- Menampilkan Hari -->
                        <h5>Hari</h5>
                        <p>{{ $jadwal->hari ?? 'Tidak Tersedia' }}</p>
                        <hr>

                        <!-- Menampilkan Jam Mulai -->
                        <h5>Mulai</h5>
                        <p>{{ $jadwal->jam_mulai ?? 'Tidak Tersedia' }}</p>
                        <hr>

                        <!-- Menampilkan Jam Selesai -->
                        <h5>Selesai</h5>
                        <p>{{ $jadwal->jam_selesai ?? 'Tidak Tersedia' }}</p>
                        <hr>

                        <!-- Menampilkan Nomor Antrian -->
                        <h5>Nomor Antrian</h5>
                        <button class="btn btn-success">{{ $daftarpoli->no_antrian ?? 'Tidak Tersedia' }}</button>
                        <hr>

                        <!-- Menampilkan Status Pemeriksaan -->
                        <h5>Status Pemeriksaan</h5>
                        <p>{{ $status }}</p>
                        <hr>
                    </center>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <a href="{{ url('pasien/riwayat-poli') }}" class="btn btn-primary btn-block">Kembali</a>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
