@extends('Layout.header')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tanggapi Pertanyaan Konsultasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dokter.konsultasi.index') }}">Konsultasi</a></li>
                        <li class="breadcrumb-item active">Tanggapi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tanggapan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('dokter.konsultasi.update', $konsultasi->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="pertanyaan">Pertanyaan</label>
                                    <textarea id="pertanyaan" class="form-control" rows="3" readonly>{{ $konsultasi->pertanyaan }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="jawaban">Jawaban</label>
                                    <textarea name="jawaban" id="jawaban" class="form-control" rows="5" required>{{ $konsultasi->jawaban }}</textarea>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
                                    <a href="{{ route('dokter.konsultasi.index') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection