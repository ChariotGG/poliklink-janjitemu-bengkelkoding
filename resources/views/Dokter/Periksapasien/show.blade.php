@extends('Layout.header')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pemeriksaan Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pemeriksaan</a></li>
                        <li class="breadcrumb-item active">Detail Pemeriksaan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Detail Pemeriksaan</h3>
                </div>
                <div class="card-body">
                    <h5>Nama Pasien</h5>
                    <p>{{ $pemeriksaan->daftarPoli->pasien->nama }}</p>
                    <hr>

                    <h5>Catatan Pemeriksaan</h5>
                    <p>{{ $pemeriksaan->catatan }}</p>
                    <hr>

                    <h5>Biaya Pemeriksaan</h5>
                    <p>Rp {{ number_format($pemeriksaan->biaya_periksa, 0, ',', '.') }}</p>
                    <hr>

                    <h5>Obat yang Diberikan</h5>
                    <ul>
                        @foreach ($detail_periksa as $detail)
                            <li>{{ $detail->obat->nama_obat }} - Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                    <hr>

                    <h5>Total Biaya Obat</h5>
                    <p>Rp {{ number_format($total_biaya, 0, ',', '.') }}</p>
                    <hr>

                    <a href="{{ url('dokter/periksa-pasien') }}" class="btn btn-primary btn-block">Kembali</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
