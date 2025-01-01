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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Inputkan Dokter</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('dokter-post')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="namapoli">Username Dokter</label>
                                    <input type="text" name="username" class="form-control " >
                                </div>
                                <div class="form-group">
                                    <label for="namapoli">Nama Dokter</label>
                                    <input type="text" name="nama_dokter" class="form-control " >
                                </div>
                                <div class="form-group">
                                    <label for="namapoli">Alamat</label>
                                    <input type="text" name="alamat" class="form-control " >
                                </div>
                                <div class="form-group">
                                    <label for="namapoli">No Hp</label>
                                    <input type="text" name="no_hp" class="form-control " >
                                </div>
                                <div class="form-group">
                                    <label for="namapoli">Poli</label>
                                    <select name="id_poli" class="form-control ">
                                        <option value="#">== Silahkan Pilih ==</option>
                                        @foreach ($poli as $polri)
                                            <option value="{{$polri->id}}">{{$polri->nama_poli}}</option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Dokter</h3>

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
                                        <th>Nama Dokter</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th>Poli</th>
                                        <th>Katasandi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dokter as $polri)
                                    <tr>

                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$polri->nama_dokter}}</td>
                                        <td>{{$polri->alamat}}</td>
                                        <td>{{$polri->no_hp}}</td>
                                        <td>{{$polri->poli->nama_poli}}</td>
                                        <td>{{$polri->katasandi}}</td>
                                        <td>
                                            <div class="d-flex justify-content">
                                                <a href="{{ url('admin/dokter/' . $polri->id) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ url('admin/dokter/' . $polri->id) }}/delete" method="POST" style="margin-left: 10px;">
                                                    @csrf
                                                    <button class="btn btn-danger" onclick="confirmDelete('{{ url('admin/dokter/' . $polri->id) }}/delete')">Hapus</button>                                                    </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>Kosong</td>
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