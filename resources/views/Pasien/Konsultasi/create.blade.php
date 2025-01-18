@extends('Layout.header')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Pertanyaan Konsultasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pasien.konsultasi.index') }}">Konsultasi</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
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
                            <h3 class="card-title">Form Tambah Pertanyaan</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pasien.konsultasi.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="id_dokter">Pilih Dokter</label>
                                    <select name="id_dokter" id="id_dokter" class="form-control" required>
                                        <option value="" disabled selected>Pilih Dokter</option>
                                        @foreach($dokter as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="pertanyaan">Pertanyaan</label>
                                    <textarea name="pertanyaan" id="pertanyaan" class="form-control" rows="5" required></textarea>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                    <a href="{{ route('pasien.konsultasi.index') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection