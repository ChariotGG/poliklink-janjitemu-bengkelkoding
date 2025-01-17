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
                        <p>{{$riwayat->daftarPoli->jadwalPeriksa->dokter->poli->nama_poli}}</p>
                        <hr>

                        <!-- Menampilkan Nama Dokter -->
                        <h5>Nama Dokter</h5>
                        <p>{{$riwayat->daftarPoli->jadwalPeriksa->dokter->nama}}</p>
                        <hr>

                        <!-- Menampilkan Hari -->
                        <h5>Hari</h5>
                        <p>{{$riwayat->tanggal_periksa}}</p>
                        <hr>

                        <h5>Catatan</h5>
                        <p>{{$riwayat->catatan}}</p>
                        <hr>
                        
                        <h5>Obat</h5>
                        @foreach($obat->where('id_periksa',$riwayat->id) as $o)
                        <p>- {{$o->obat->nama_obat}}</p>
                        @endforeach
                        <hr>

                        <h5>Biaya periksa</h5>
                        <p>{{$riwayat->biaya_periksa}}</p>
                        <hr>
                    </center>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <a href="{{ url('dokter/riwayat-pasien') }}" class="btn btn-primary btn-block">Kembali</a>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection