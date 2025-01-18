@extends('Layout.header')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Konsultasi Medis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Konsultasi</li>
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
                            <h3 class="card-title">Daftar Konsultasi dari Pasien</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Tanggal Konsultasi</th>
                                        <th>Nama Pasien</th>
                                        <th>Subject</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($konsultasi as $item)
                                    <tr>
                                        <td>{{ $item -> tgl_konsultasi }}</td>
                                        <td>{{ $item->pasien->nama }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>{{ $item->pertanyaan }}</td>
                                        <td>{{ $item->jawaban ?? 'Belum dijawab' }}</td>
                                        <td>
                                            @if(is_null($item->jawaban))
                                            <a href="{{ route('dokter.konsultasi.tanggapi', $item->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-reply"></i> Tanggapi
                                            </a>
                                            @else
                                            <a href="{{ route('dokter.konsultasi.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada konsultasi.</td>
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
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection