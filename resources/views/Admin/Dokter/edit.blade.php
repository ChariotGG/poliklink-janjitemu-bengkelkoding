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
                            <h3 class="card-title">Edit Nama Dokter</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('dokter-update',$dokter->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="namapoli">Nama Dokter</label>
                                    <input type="text" name="nama_dokter" class="form-control "
                                        value="{{$dokter->nama_dokter}}">
                                </div>

                                <div class="form-group">
                                    <label for="namapoli">Alamat</label>
                                    <input type="text" name="alamat" class="form-control "
                                        value="{{$dokter->alamat}}">
                                </div>

                                <div class="form-group">
                                    <label for="namapoli">No Hp</label>
                                    <input type="text" name="no_hp" class="form-control "
                                        value="{{$dokter->no_hp}}">
                                </div>

                                <div class="form-group">
                                    <label for="namapoli">Poli</label>
                                    <select name="id_poli" class="form-control ">
                                        @foreach($poli as $p)
                                            <option value="{{$p->id}}">{{$p->nama_poli}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="namapoli">Password</label>
                                    <input type="text" name="password" class="form-control "
                                        value="{{$dokter->katasandi}}">
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection